<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 20-Feb-18
 * Time: 16:27
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "ערוך אירוע");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$eventId = $_GET["EventId"];
try{
    $eventObj = Event::GetById($eventId);
} catch (\Throwable $e){
    \Services::RedirectHome();
}

if(isset($_POST["edit-event-form-submit"])) {
    if(!empty($_POST["edit-event-form-subject"]) && !empty($_POST["edit-event-form-start-date"]) && !empty($_POST["edit-event-form-end-date"]) && !empty($_POST["edit-event-form-content"])) {
        try {
            $arrayToUpdate = array("Title" => $_POST["edit-event-form-subject"],
                "SubTitle" => $_POST["edit-event-form-subtitle"],
                "Content" => $_POST["edit-event-form-content"],
                "StartEvent" => $_POST["edit-event-form-start-date"],
                "EndEvent" => $_POST["edit-event-form-end-date"]
            );
            $eventObj->Update($arrayToUpdate);

            //log
            $userObj = User::GetById($_SESSION["UserId"]);
            $logString = "האירוע <b>{$eventObj->GetTitle()}</b> נערך על ידי המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
            Rimon::NewLog($logString);

            header("Location: calendar.php");
        } catch (\Throwable $e){
            echo $e->getMessage();
        }

    } else {
        echo "נא למלא את כל השדות הנדרשים";
    }
}

$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom1.jpg">
        </div>  
    </div> 
 
    <div class="row" style="padding: 40px 0">
        <div class="col-sm-12">  
                    <h2 class="subtitles">עריכת אירוע - {$eventObj->GetTitle()}</h2>

            <form method="post" role="form"> 
               
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-event-form-subject">כותרת האירוע</label>
                          <input type="text" class="form-control" id="edit-event-form-subject" name="edit-event-form-subject" value="{$eventObj->GetTitle()}" required>
                     </div>
                </div> 
                
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-event-form-subtitle">כותרת משנה</label>
                          <input type="text" class="form-control" id="edit-event-form-subtitle" name="edit-event-form-subtitle" value="{$eventObj->GetSubTitle()}" required>
                     </div>
                </div>
                
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-event-form-start-date">תאריך התחלה</label>
                          <input type="text" id="edit-event-form-start-date" class="form-control datepicker" value="{$eventObj->GetStartEvent()->format("Y-m-d")}" name="edit-event-form-start-date" required>
                     </div>
                </div>

                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-event-form-end-date">תאריך סיום</label>
                          <input type="text" id="edit-event-form-end-date" class="form-control datepicker" value="{$eventObj->GetEndEvent()->format("Y-m-d")}" name="edit-event-form-end-date" required>
                     </div>
                </div>
                
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-event-form-content">תוכן האירוע</label>
                    <textarea id="edit-job-form-content" name="edit-event-form-content" class="form-control editarea" required>{$eventObj->GetContent()}</textarea>
                     </div>
                </div>
                
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                    <input type="submit" value="עדכן אירוע" name="edit-event-form-submit" class="btn btn-info btn-block">
                </div>      
           </form> 
        </div>
    </div>
</div>

  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      yearRange: "-10:+10",
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  } );
  </script>
Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;


?>
