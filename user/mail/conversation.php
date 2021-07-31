<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 24-Feb-18
 * Time: 18:11
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "שיחה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);

if(!isset($_GET["Con"]))
    \Services::RedirectHome();

$conversationLinkDecode = explode("_",base64_decode($_GET["Con"]));
try {
    $conversationObj = Conversation::GetById($conversationLinkDecode[0]);
} catch (\Throwable $e){
    \Services::RedirectHome();
}
//Security
if($conversationLinkDecode[1] != $conversationObj->GetDatetime()->format("U"))
    \Services::RedirectHome();

$usersExistsCheck = false;
foreach ($conversationObj->GetUsers() as $user) {
    if($userObj->GetId() === $user->GetId()) {
        $usersExistsCheck = true;
        break;
    }
}

if($usersExistsCheck == false)
    \Services::RedirectHome();
//////

if(isset($_POST["conversation-add-message-submit"]) && !empty($_POST["conversation-add-message"])) {
    $datetime =  new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
    $arrayToInsert = array(
        "ConversationId" => $conversationObj->GetId(),
        "SentBy" => $userObj->GetId(),
        "Datetime" => $datetime->format("Y-m-d H:i:s"),
        "Message" => $_POST["conversation-add-message"]
    );

    try {
        PrivateMessage::NewMessage($arrayToInsert);

        //log
        $logString = "המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> הוסיף הודעה לשיחה מספר <b>{$conversationObj->GetId()}</b>";
        Rimon::NewLog($logString);

        $conversationLinkEncode = base64_encode($conversationObj->GetId() . "_" . $conversationObj->GetDatetime()->format("U"));
        header("Location: conversation.php?Con=" . $conversationLinkEncode);
    } catch (\Throwable $e) {
        echo $e->getMessage();
    }
}
//$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom1.jpg" style="margin: 0">
        </div>  
    </div>
     
    {MessagesPlace}

</div>
Index;

$conversationMembers = "";
foreach ($conversationObj->GetUsers() as $user) {
    $conversationMembers .= "{$user->GetFullName()}, ";
}

$allmessagesHtml = <<<AllMessages
<div class="row">
    <div class="col-sm-12 chat-box">
        <div class="chat-header">
            <h3>יוצר השיחה: {$conversationObj->GetOpenBy()->GetFullName()}</h3>
            <h4 style="margin-bottom: 20px">משתתפים: {$conversationMembers}</h4>
        </div>
        
        <ol class="chat">
            {AllMessages}
        </ol>

       <form method="post" role="form"> 
       
            <div class="col-xs-10 pull-right">
                <div class="form-group">
                    <input type="text" class="form-control" id="conversation-add-message" name="conversation-add-message" placeholder="תוכן ההודעה" required autocomplete="off">
                </div>
            </div>
        
            <div class="col-xs-2">                   
                <input type="submit" value="שלח הודעה" name="conversation-add-message-submit" class="btn btn-info btn-block">
            </div>  
       </form> 
        
    </div>
</div>
AllMessages;



$messageHtml = <<<Message

<li class="{WhoSend}">
    <div class="avatar"><img src="{userAvatar}" draggable="false"/></div>
    <div class="msg">
        <h4>{MessageFrom}</h4>
        <p>{MessageContent}</p>
        <time>{MessageDate}</time>
    </div>
</li>

Message;

$messageLoop = "";
foreach ($conversationObj->GetMessages() as $message) {
    $messageLoop .= $messageHtml;
    \Services::setPlaceHolder($messageLoop, "MessageDate", $message->GetDatetime()->format("d/m/y H:m"));
    \Services::setPlaceHolder($messageLoop, "MessageFrom", $message->GetSentBy()->GetFullName());
    \Services::setPlaceHolder($messageLoop, "MessageContent", $message->GetMessage());

    if($message->GetSentBy()->GetId() === $userObj->GetId()) {
        \Services::setPlaceHolder($messageLoop, "WhoSend", "self");
        \Services::setPlaceHolder($messageLoop, "userAvatar", "../../media/icons/chat/face1.png");
    }
    else {
        \Services::setPlaceHolder($messageLoop, "WhoSend", "other");
        \Services::setPlaceHolder($messageLoop, "userAvatar", "../../media/icons/chat/face2.png");
    }
}
\Services::setPlaceHolder($allmessagesHtml, "AllMessages", $messageLoop);
\Services::setPlaceHolder($pageTemplate, "MessagesPlace", $allmessagesHtml);



$conversationObj->UpdateUserLastView($userObj->GetId());

$pageTemplate .= footerTemplate;
echo $pageTemplate;
