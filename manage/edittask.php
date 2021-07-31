<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 20-Feb-18
 * Time: 16:11
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

try{
    $taskObj = Task::GetById($_GET["TaskId"]);
} catch (\Throwable $e){
    \Services::RedirectHome();
}


if(isset($_POST["edit-task-form-submit"])) {

    if(!empty($_POST["edit-task-form-subject"] && $_POST["edit-task-form-content"])) {

        $taskTeam = $_POST["edit-task-form-team"];
        $taskSubject = $_POST["edit-task-form-subject"];
        $taskContent = $_POST["edit-task-form-content"];

        $arrayToInsert = array("Subject" => $taskSubject,
            "Task" => $taskContent,
            "Team" => $taskTeam,
        );
        try {
            $taskObj->Update($arrayToInsert);

            //log
            $userObj = User::GetById($_SESSION["UserId"]);
            $logString = "משימה מספר <b>{$taskObj->GetId()}</b> נערכה על ידי <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
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
            <img src="../media/pages/unitrandom8.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12">
            <h2 class="subtitles">עריכת משימה</h2>
        </div>
    </div> 
    
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1">
               <form method="post" role="form"> 
                  
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-task-form-subject">נושא</label>
                              <input type="text" class="form-control" id="edit-task-form-subject" name="edit-task-form-subject" value="{$taskObj->GetSubject()}" required>
                         </div>
                   </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>עבור צוות:</label><br>
                            <select class="form-control" name="edit-task-form-team">
                                {teamsList}
                            </select>
                        </div>
                    </div>
                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-task-form-content">תוכן המשימה</label>
                        <textarea id="edit-job-form-content" name="edit-task-form-content" class="form-control editarea" required>{$taskObj->GetTask()}</textarea>
                         </div>
                   </div>
                   
                  
                   
                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="עדכן משימה" name="edit-task-form-submit" class="btn btn-info btn-block">
                    </div>  
                    
               </form> 
        </div>
    </div>
</div>
Index;

$allTeams = Rimon::GetDB()->get("teams");
$teamsList = "";
foreach ($allTeams as $team){
    $teamsList .= "<option value='".$team["Id"]."' ";
    if ($taskObj->GetTeam()->GetId() == $team["Id"]){
        $teamsList .= "selected='selected'";}
    $teamsList .= ">".$team["Name"]."</option>";
}
\Services::setPlaceHolder($pageTemplate,"teamsList",$teamsList);



$pageTemplate .= footerTemplate;
echo $pageTemplate;
