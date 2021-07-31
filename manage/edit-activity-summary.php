<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 19-Feb-18
 * Time: 14:46
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "עריכת סיכום אירוע");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$summaryId = $_GET["SummaryId"];
try{
    $summaryObj = ActivitySummary::GetById($summaryId);
} catch (\Throwable $e){
    \Services::RedirectHome();
}

if(isset($_POST["edit-summary-form-submit"])){

    $subject = $_POST["edit-summary-form-subject"];
    $type = $_POST["edit-summary-form-type"];
    $location = $_POST["edit-summary-form-location"];
    $content = $_POST["edit-summary-form-content"];
    $date = $_POST["edit-summary-form-date"];
    $team = $_POST["edit-summary-form-team"];

    /////list of presents.
    $allPresents = "";
    $presentIndexCounter = 0;
    $presentIndex = count($_POST["edit-summary-form-present-list"]);
    foreach ($_POST["edit-summary-form-present-list"] as $present){
        $addPresent = "{$present}";

        if($presentIndexCounter < $presentIndex -1)
            $addPresent .= ",";
        else
            $addPresent .= "";

        $allPresents .= $addPresent;
        $presentIndexCounter++;
    }
//////

    $arrayToInsert = array(
        "Team" => $team,
        "Subject" => $subject,
        "Type" => $type,
        "Location" => $location,
        "Date" => $date,
        "Presents" => $allPresents,
        "Content" => $content
    );

    try {
        $summaryObj->Update($arrayToInsert);

        //log
        $userObj = User::GetById($_SESSION["UserId"]);
        $logString = "סיכום אירוע מספר {$summaryObj->GetId()} נערך על ידי {$userObj->GetFullName()} תז {$userObj->GetId()}";
        Rimon::NewLog($logString);


        header("Location: summary-board.php");
    } catch (\Throwable $e){
        echo $e->getMessage();
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
            <h2 class="subtitles">עריכת סיכום</h2>
        </div>
    </div> 
    
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1">
               <form method="post" role="form">
                  
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-summary-form-subject">נושא הפעילות</label>
                              <input type="text" class="form-control" id="edit-summary-form-subject" name="edit-summary-form-subject" value="{$summaryObj->GetSubject()}" required>
                         </div>
                   </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>סוג</label><br>
                            <select class="form-control" name="edit-summary-form-type">
                                {activityType}
                            </select>
                        </div>
                    </div>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                            <label>עבור צוות:</label><br>
                            <select class="form-control" name="edit-summary-form-team">
                                {teamsList}
                            </select>
                        </div>
                    </div> 
                   
                   <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-summary-form-date">תאריך האירוע</label>
                          <input type="text" id="edit-summary-form-date" class="form-control datepicker" value="{$summaryObj->GetDate()->format("Y-m-d")}" name="edit-summary-form-date" required>
                     </div>
                   </div>
                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-summary-form-location">מיקום</label>
                              <input type="text" class="form-control" id="edit-summary-form-location" name="edit-summary-form-location" value="{$summaryObj->GetLocation()}">
                         </div>
                   </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>נוכחים</label>
                            <ul class="multi-column">
                             {presentsList}
                            </ul>
                        </div>
                    </div>

                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-summary-form-content">סיכום</label>
                              <textarea id="edit-summary-form-content" name="edit-summary-form-content" class="form-control editarea"  required>{$summaryObj->GetContent()}</textarea>
                         </div>
                   </div>
                   
                  
                   
                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="עדכן סיכום" name="edit-summary-form-submit" class="btn btn-info btn-block">
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
    if ($summaryObj->GetTeam()->GetId() == $team["Id"]){
        $teamsList .= "selected='selected'";}
    $teamsList .= ">".$team["Name"]."</option>";
}
\Services::setPlaceHolder($pageTemplate,"teamsList",$teamsList);




$summaryTypeString = "";
foreach (EActivityType::toArray() as $type) {
    $summaryTypeString .= "<option value='".$type[0]."' ";
    if ($summaryObj->GetType()->getValue() == $type[0]){
        $summaryTypeString .= "selected='selected'";}
    $summaryTypeString .= ">".$type[1]."</option>";
}
\Services::setPlaceHolder($pageTemplate, "activityType", $summaryTypeString);



////Present
$userFromDBSummary = Rimon::GetDB()->where("Id", $summaryObj->GetId())->getOne("activitySummary","Presents");
$activitiesInSummaryArray = explode(",", $userFromDBSummary["Presents"]);
$allActiveUsers = Rimon::GetDB()->where("Role", 4,">=")->get("users");
$activeUserList = "";
foreach ($allActiveUsers as $activeUser){
    if(in_array($activeUser["Id"],$activitiesInSummaryArray)) {
        $activeUserList .= "<li><label><input type=\"checkbox\" name=\"edit-summary-form-present-list[]\" value=\"{$activeUser["Id"]}\" checked>{$activeUser["FirstName"]} {$activeUser["LastName"]}  </label></li>";
    } else {
        $activeUserList .= "<li><label><input type=\"checkbox\" name=\"edit-summary-form-present-list[]\" value=\"{$activeUser["Id"]}\">{$activeUser["FirstName"]} {$activeUser["LastName"]}</label></li>";
    }
}
\Services::setPlaceHolder($pageTemplate,"presentsList",$activeUserList);
////


$pageTemplate .= footerTemplate;
echo $pageTemplate;
