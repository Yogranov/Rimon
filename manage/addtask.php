<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 06-Feb-18
 * Time: 22:00
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הוספת משימה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);


if(isset($_POST["add-task-form-submit"])) {
    if(!empty($_POST["add-task-form-subject"] && $_POST["add-task-form-content"])) {

        $taskTeam = $_POST["add-task-form-team"];
        $taskSubject = $_POST["add-task-form-subject"];
        $taskContent = $_POST["add-task-form-content"];
        $time = new \DateTime('now',new \DateTimeZone('Asia/Jerusalem'));


        $arrayToInsert = array("Subject" => $taskSubject,
                                "Task" => $taskContent,
                                "Status" => 1,
                                "CreateBy" => $userObj->GetId(),
                                "Team" => $taskTeam,
                                "OpenDate" => $time->format("Y-m-d H:i:s")
                                );
        try {
            Task::Add($arrayToInsert);

            //log
            $logString = "משימה חדשה נוצרה על ידי המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>.";
            Rimon::NewLog($logString);

            header("Location: tasks.php");
        } catch (\Throwable $e){
            echo $e->getMessage();
        }

    } else {
        echo "נא למלא את כל השדות הנדרשים";
    }
}

$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom7.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12">
            <h2 class="subtitles">הוסף משימה חדשה</h2>
        </div>
    </div> 
    
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1">
           <form method="post" role="form"> 
              
               <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-task-form-subject">נושא</label>
                          <input type="text" class="form-control" id="add-task-form-subject" name="add-task-form-subject" placeholder="נושא המשימה" required>
                     </div>
               </div>
               
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>עבור צוות:</label><br>
                        <select class="form-control" name="add-task-form-team">
                            {teamsList}
                        </select>
                    </div>
                </div>
               
               <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-task-form-content">תוכן המשימה</label>
                    <textarea id="add-job-form-content" name="add-task-form-content" class="form-control editarea" required>תוכן משימה..</textarea>
                     </div>
               </div>
               
              
               
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                    <input type="submit" value="צור משימה חדשה" name="add-task-form-submit" class="btn btn-info btn-block">
                </div>  
                
           </form> 
        </div>
    </div>
</div>
Index;


$allTeams = Rimon::GetDB()->get("teams");
$teamsList = "";
foreach ($allTeams as $team){
    $teamsList .= "
        <option value=\"{$team["Id"]}\">{$team['Name']}</option>
    ";
}
\Services::setPlaceHolder($pageTemplate,"teamsList",$teamsList);

$pageTemplate .= footerTemplate;
echo $pageTemplate;
