<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Feb-18
 * Time: 10:56
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הוספת סיכום");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



if(isset($_POST["add-summary-form-submit"])){
    $subject = $_POST["add-summary-form-subject"];
    $type = $_POST["add-summary-form-type"];
    $location = $_POST["add-summary-form-location"];
    $content = $_POST["add-summary-form-content"];
    $date = $_POST["add-summary-form-date"];
    $team = $_POST["add-summary-form-team"];

    /////list of presents.
    $allPresents = "";
    $presentIndexCounter = 0;
    $presentIndex = count($_POST["add-summary-form-present-list"]);
    foreach ($_POST["add-summary-form-present-list"] as $present){
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
        ActivitySummary::Add($arrayToInsert);

        //log
        $userObj = User::GetById($_SESSION["UserId"]);
        $logString = "סיכום אירוע חדש נוצר על ידי המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>.";
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
            <img src="../media/pages/unitrandom3.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12">
            <h2 class="subtitles">סיכום חדש</h2>
        </div>
    </div> 
    
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1">
               <form method="post" role="form"> 
                  
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="add-summary-form-subject">נושא הפעילות</label>
                              <input type="text" class="form-control" id="add-summary-form-subject" name="add-summary-form-subject" placeholder="נושא הפעילות" required>
                         </div>
                   </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>סוג</label><br>
                            <select class="form-control" name="add-summary-form-type">
                                {activityTypes}
                            </select>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>עבור צוות:</label><br>
                            <select class="form-control" name="add-summary-form-team">
                                {teamsList}
                            </select>
                        </div>
                    </div> 
                   
                   <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-summary-form-date">תאריך האירוע</label>
                          <input type="text" id="add-summary-form-date" class="form-control datepicker" name="add-summary-form-date" required>
                     </div>
                   </div>
                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="add-summary-form-location">מיקום</label>
                              <input type="text" class="form-control" id="add-summary-form-location" name="add-summary-form-location" placeholder="שם העיר, הבית">
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
                              <label for="add-summary-form-content">סיכום</label>
                              <textarea id="add-summary-form-content" name="add-summary-form-content" class="form-control editarea" required>תוכן הסיכום..</textarea>
                         </div>
                   </div>
                   
                  
                   
                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="צור סיכום" name="add-summary-form-submit" class="btn btn-info btn-block">
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


///echo all the teams
$allTeams = Rimon::GetDB()->get("teams");
$teamsList = "";
foreach ($allTeams as $team){
    $teamsList .= "
        <option value=\"{$team["Id"]}\">{$team['Name']}</option>
    ";
}
\Services::setPlaceHolder($pageTemplate,"teamsList",$teamsList);
///


///echo the activity types to form
$activityTypes = "";
foreach (EActivityType::toArray() as $activityType){
    $activityTypes .= "<option value=\"{$activityType[0]}\">$activityType[1]</option>";
}
\Services::setPlaceHolder($pageTemplate,"activityTypes",$activityTypes);
////

////Present
$allActiveUsers = Rimon::GetDB()->where("Role", 4,">=")->get("users");
$activeUserList = "";
foreach ($allActiveUsers as $activeUser){
    $activeUserList .= "<li><label><input type=\"checkbox\" name=\"add-summary-form-present-list[]\" value=\"{$activeUser["Id"]}\">{$activeUser["FirstName"]} {$activeUser["LastName"]}</label></li>";
}
\Services::setPlaceHolder($pageTemplate,"presentsList",$activeUserList);
////


$pageTemplate .= footerTemplate;
echo $pageTemplate;
