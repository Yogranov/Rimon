<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 10-Feb-18
 * Time: 14:14
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הוסף אירוע");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

if(isset($_POST["add-event-form-submit"])) {
    if(!empty($_POST["add-event-form-subject"]) && !empty($_POST["add-event-form-start-date"]) && !empty($_POST["add-event-form-end-date"]) && !empty($_POST["add-event-form-content"])) {
        try {
            Event::NewEvent($_POST["add-event-form-subject"],
                $_POST["add-event-form-subtitle"],
                $_POST["add-event-form-content"],
                $_POST["add-event-form-start-date"],
                $_POST["add-event-form-end-date"],
                $_SESSION["UserId"],
                $_POST["add-event-form-end-date"]
            );
            $userObj = User::GetById($_SESSION["UserId"]);
            //log
            $logString = "אירוע חדש (<b>{$_POST["add-event-form-subject"]}</b>) נוצר על ידי <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
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
            <img src="../../media/pages/unitrandom6.jpg">
        </div>  
    </div>
    <div class="row" style="padding: 40px 0">
        <div class="col-sm-12">  
            <form method="post" role="form"> 
               
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-event-form-subject">כותרת האירוע</label>
                          <input type="text" class="form-control" id="add-event-form-subject" name="add-event-form-subject" placeholder="כותרת האירוע" required>
                     </div>
                </div> 
                
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-event-form-subtitle">כותרת משנה</label>
                          <input type="text" class="form-control" id="add-event-form-subtitle" name="add-event-form-subtitle" placeholder="כותרת משנה" required>
                     </div>
                </div> 
                
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-event-form-start-date">תאריך התחלה</label>
                          <input type="text" id="add-event-form-start-date" class="form-control datepicker" name="add-event-form-start-date" required>
                     </div>
                </div>

                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-event-form-end-date">תאריך סיום</label>
                          <input type="text" id="add-event-form-end-date" class="form-control datepicker" name="add-event-form-end-date" required>
                     </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <p><b>מי יוכל לראות את האירוע?</b></p>
                        <select class="form-control" name="new-user-form-military-type">
                            <option value="0">פתוח לכולם</option>
                            <option value="2">חברי עמותה</option>
                            <option value="3">חברי עמותה VIP</option>
                            <option value="4">פעילים עמותה</option>
                            <option value="5">ראשי צוותים</option>
                            <option value="6">מנהלים</option>
                        </select>
                       </div>
                   </div>
                
                <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-event-form-content">תוכן האירוע</label>
                    <textarea id="add-job-form-content" name="add-event-form-content" class="form-control editarea" required>תוכן האירוע..</textarea>
                     </div>
                </div>
                
                
                
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                    <input type="submit" value="צור אירוע חדש" name="add-event-form-submit" class="btn btn-info btn-block">
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
