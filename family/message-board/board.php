<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 15-Mar-18
 * Time: 11:18
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "לוח מודעות");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj =User::GetById($_SESSION["UserId"]);

if($userObj->GetRole()->getValue() >= 4 && $_GET["DeleteMessageId"]){
    try{
        $tmpMessage = MessageBoard::GetById($_GET["DeleteMessageId"]);
        $tmpMessage->Update(array("Status" => 0));
        //log
        $logString = "המודעה <b>{$tmpMessage->GetTitle()}</b> נמחקה על ידי המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
        Rimon::NewLog($logString);
        header("Location: board.php");
    } catch (\Throwable $e){
    echo $e->getMessage();
    }
}




$pageTemplate .= <<<Index
<div class="container content">

    <div class="row">
        <div class="col-sm-12 page-photo" >
            <img src="../../media/pages/projects-race-1.jpg">
        </div>  
    </div>
    
    <div class="row">
        <div class="col-sm-12 pull-right" style="width: 100%">
            <h2 class="subtitles" data-aos="zoom-in">לוח מודעת</h2>
        </div>  
    </div>
        {AddNewMessage}
   {FullMessageBoard}
        
        
    </div>
Index;

$allMessages = Rimon::GetDB()->where("Status", 1)->get("messageBoard");

if(!empty($allMessages)) {

    $messageBoard = <<<MassageBoard
<div class="row">
{Messages}
</div>
MassageBoard;

    $messageRowTemplate = <<<MessageRow
<div class="col-sm-4 col-md-4" data-aos="zoom-in">
                <div class="post">
                    <div class="post-img-content">
                        <img src="uploads/{MessageImageName}" class="img-responsive" />
                        <span class="post-title"><b>{MessageTitle}</b></span>
                    </div>
                    <div class="content">
                        <div class="author">
                            נוצר ע"י <b>{MessageOpenBy}</b> |
                            <time datetime="2014-01-20">{MessageOpenDate}</time>
                        </div>
                        <div>
                            <p>{MessageContent}</p>
                        </div>
                        {EditMessageButton}
                        {DeleteMessageButton}
                    </div>
                </div>
            </div>
MessageRow;

$messageRow = "";
foreach ($allMessages as $message) {
    $messageObj = MessageBoard::GetById($message["Id"]);
    $messageRow .= $messageRowTemplate;

    \Services::setPlaceHolder($messageRow, "MessageImageName", $messageObj->GetImageName());
    \Services::setPlaceHolder($messageRow, "MessageTitle", $messageObj->GetTitle());
    \Services::setPlaceHolder($messageRow, "MessageOpenBy", $messageObj->GetOpenBy()->GetFullName());
    \Services::setPlaceHolder($messageRow, "MessageOpenDate", $messageObj->GetOpenDate()->format("d/m/Y"));
    \Services::setPlaceHolder($messageRow, "MessageContent", $messageObj->GetContent());

    if($userObj->GetRole()->getValue() >= 4) {
        \Services::setPlaceHolder($messageRow, "EditMessageButton", "<button style='width: 100px' class='btn btn-warning btn-block pull-right' onclick=\"window.location='edit-message.php?MessageId={$messageObj->GetId()}'\">עריכה</button>");
        \Services::setPlaceHolder($messageRow, "DeleteMessageButton", "<button style='width: 100px' class='btn btn-danger btn-block pull-left' onclick=\"window.location='board.php?DeleteMessageId={$messageObj->GetId()}'\">מחק</button>");
    } else {
        \Services::setPlaceHolder($messageRow, "EditMessageButton", "");
    }
}
\Services::setPlaceHolder($messageBoard, "Messages", $messageRow);
\Services::setPlaceHolder($pageTemplate, "FullMessageBoard", $messageBoard);
}
\Services::setPlaceHolder($pageTemplate, "FullMessageBoard", "<center><h2>אין מודעות</h2></center>");



if($userObj->GetRole()->getValue() >= 4)
    \Services::setPlaceHolder($pageTemplate, "AddNewMessage", "<button style='width: 150px' class='btn btn-warning btn-block' onclick=\"window.location='new-message.php'\">מודעה חדשה</button>");
else
    \Services::setPlaceHolder($pageTemplate, "AddNewMessage", "");


$pageTemplate .= footerTemplate;
echo $pageTemplate;
