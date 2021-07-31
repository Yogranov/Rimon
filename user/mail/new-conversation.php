<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 24-Feb-18
 * Time: 20:25
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "שיחה חדשה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);


$error = "";
if(isset($_POST["add-conversation-submit"]) && !empty($_POST["add-conversation-subject"]) && !empty($_POST["add-conversation-users"])){
    $users = implode(",", $_POST["add-conversation-users"]);
    $users .= "," . $_SESSION["UserId"];
    $userLaseView = array();
    foreach ($_POST["add-conversation-users"] as $user) {
        $userLaseView["$user"] = "2010-01-01";

    }
    $datetime = new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
    $conArrayToInsert = array(
        "Datetime" => $datetime->format("Y-m-d H:i:s"),
        "Subject" => $_POST["add-conversation-subject"],
        "Users" => $users,
        "UserLastView" => json_encode($userLaseView),
        "OpenBy" => $userObj->GetId(),
        "Show" => 1
    );

    $addNewCon = Conversation::New($conArrayToInsert);

    //log
    $logString = "שיחה חדשה נוצרה על ידי המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
    Rimon::NewLog($logString);

    $messageArrayToInsert = array(
        "ConversationId" => $addNewCon->GetId(),
        "SentBy" => $userObj->GetId(),
        "Datetime" => $datetime->format("Y-m-d H:i:s"),
        "Message" => $_POST["add-conversation-text"]
    );
    PrivateMessage::NewMessage($messageArrayToInsert);

    $conversationLinkEncode = base64_encode($addNewCon->GetId() . "_" . $addNewCon->GetDatetime()->format("U"));

    header("Location: conversation.php?Con=" . $conversationLinkEncode);
}

//$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/fire-range.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12">
            <h2 class="subtitles">יצירת שיחה חדשה</h2>
        </div>
    </div>
    <div class="row the-unit" style="border: none">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
               <form method="post" role="form">
                   <div id="new-conversation-form">
                   
                      <div class="col-sm-12">
                            <div class="form-group">
                                 <label for="add-conversation-subject">נושא</label>
                                 <input type="text" class="form-control" id="add-conversation-subject" name="add-conversation-subject" placeholder="נושא השיחה" required>
                            </div>
                      </div>
                       
                      <div class="col-xs-12 col-sm-10 pull-right">
                            <div class="form-group">
                                 <label for="add-conversation-search-users">חיפוש איש קשר</label>
                                 <input type="text" class="form-control" id="add-conversation-search-users" name="add-conversation-search-users" placeholder="השלמה אוטומטית עפ שם">
                            </div>
                      </div>
                        
                      <div class="col-xs-12 col-sm-2">
                            <span id="add-contact" class="btn btn-success">הוסף לשיחה</span>
                      </div>
                        
                      <div class="col-xs-12 col-sm-12">
                          <div id="conversation-members">
                             <h3>משתתפים בשיחה:</h3>
                          </div>
                      </div>
                        
                        
                      <div class="col-xs-12 col-sm-12">
                           <div class="form-group">
                                <label for="add-conversation-text">הודעה</label>
                                <textarea class="form-control" rows="5" id="add-conversation-text" name="add-conversation-text" placeholder="הודעה" required></textarea>
                           </div>
                      </div>
                     
                      <div class="col-xs-10 col-xs-offset-1" style="padding-top: 20px">                
                          <input type="submit" value="צור שיחה" name="add-conversation-submit" class="btn btn-info btn-block">
                      </div>  
                     <!-- <input type="hidden" name="add-user-form-business-token" value="{}"> -->
                     
              </button>
                  </div>
               </form> 
        </div>
    </div>
</div>
<script>
var memberValue = "";
var memberLabel = "";
$("#add-conversation-search-users").autocomplete({
      source: function(request, response ) {
        $.ajax( {
          type: "POST",
          url: "getName.php",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        event.preventDefault();
        $("#add-conversation-search-users").val(ui.item.label);
        memberValue = ui.item.value;
        memberLabel = ui.item.label;
      }
    } );

$("#add-contact").click(function() {
    if(!($("#add-conversation-search-users").val() === '')){
    $("#conversation-members").append("<li><button onclick=\"$(this).parent().remove()\" type=\"button\" class=\"btn btn-danger btn-xs btn-number\"><span class=\"glyphicon glyphicon-minus\"></span></button><input type=\"hidden\" name=\"add-conversation-users[]\" value=\"" + memberValue + "\">" + memberLabel  + "</li>");
    $("#add-conversation-search-users").val("");
    }
});
</script>
Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
