<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 13-Mar-18
 * Time: 21:34
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
$pageTemplate .= bodyTemplate;

//temp!
if(!isset($_SESSION["UserId"])) {
    header("Location: ../../login.php");
    die();
}
//

if(!isset($_GET["EventVerify"]))
    \Services::RedirectHome();

$explode = explode("_", base64_decode($_GET["EventVerify"]));

$permissionLevel = (Rimon::GetDB()->where("Id", $explode[0])->getOne("events", "ShowLevel"))["ShowLevel"];

$permissions = Rimon::GetPermissions($permissionLevel);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


try {
    $eventObj = Event::GetById($explode[0]);
} catch (\Throwable $e) {
    \Services::RedirectHome();
}

\Services::setPlaceHolder($pageTemplate, "PageTitle", $eventObj->GetTitle());


if($eventObj->GetOpenDate()->format("U") !== $explode[1])
    \Services::RedirectHome();

$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom{$GLOBALS["RANDOM_PAGE_IMAGE"]}.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="row">
        <div class="col-sm-12" style="padding: 0 25px">
            <h1 style="font-weight: bold">{$eventObj->GetTitle()}</h1>
            <h3 style="color: #4e4e4e">{$eventObj->GetSubTitle()}</h3>
            <ul style="list-style: none; margin-bottom: 30px; padding: 0">
                <li style="display: inline"> <b>מיקום האירוע:</b> {$eventObj->GetLocation()}</li>
                <li style="display: inline; padding: 0 10px"><b>תאריך האירוע:</b> {$eventObj->GetStartEvent()->format("d/m/y")}</li>
            </ul>
            
            <p style="font-size: 18px">{$eventObj->GetContent()}</p>
        </div>
    </div> 
    {CouponCode}
    {PresentsUsers}
    
    <div class="row">
        <div class="col-sm-12" style="padding: 0 25px">
        <p>
            נתראה, <br>
            צוות עמותת בוגרי רימון
        </p>
        </div>
    </div>
    
    {ManagerHTML}     
</div>
Index;

if(isset($_SESSION["UserId"])){
    $userObj = User::GetById($_SESSION["UserId"]);

    //     TEMP - START!!!!    //
    if(isset($_POST["comeOrNot"]) && $_POST["comeOrNot"] == "coming") {
        \Services::setPlaceHolder($pageTemplate, "CouponCode", "<h2><b>קוד קופון: RIMON2018</b></h2>");
    } else if(isset($_POST["comeOrNot"]) && $_POST["comeOrNot"] == "notComing") {
        \Services::setPlaceHolder($pageTemplate, "CouponCode", "");
    }

    if ($eventObj->GetId() == 1 && $eventObj->GetComingUsers() && in_array($userObj->GetId(), $eventObj->GetComingUsers())) {
        \Services::setPlaceHolder($pageTemplate, "CouponCode", "<h2><b>קוד קופון: RIMON2018</b></h2>");
    } else {
        \Services::setPlaceHolder($pageTemplate, "CouponCode", "");
    }
    //     TEMP - REMOVE!!!!    //

    $today = new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
    if((int)$today->format("U") < (int)$eventObj->GetStartEvent()->format("U") + 86400){
    ////Present Form
    if(isset($_POST["comeOrNot"])){
        if($_POST["comeOrNot"] == "coming") {
            $eventObj->MarkUserAsComing($userObj->GetId());

            //log
            $logString = "<b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> סימן 'מגיע' לאירוע <b>{$eventObj->GetTitle()}</b>";
            Rimon::NewLog($logString);
        }
        else if($_POST["comeOrNot"] == "notComing") {
            $eventObj->MarkUserAsNotComing($userObj->GetId());

            //log
            $logString = "<b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> סימן 'לא מגיע' לאירוע <b>{$eventObj->GetTitle()}</b>";
            Rimon::NewLog($logString);
        }
    }

    $presents = <<<Presents
<div class="row presence">
        <div class="col-sm-12" style="padding: 0 25px">
        <h4>אז מה אומרים? מגיעים? &#9786;</h4>
            <form style="font-size: 16px" id="event-presents-list" method="POST" role="form" onchange="this.submit()">
                {RadioBox}
            </form>
        </div>
    </div>
Presents;

    if($eventObj->GetComingUsers() && in_array($userObj->GetId(), $eventObj->GetComingUsers())) {
        $radioBox = "<label><input type=\"radio\" name=\"comeOrNot\" value=\"coming\" checked=\"checked\"> מגיע</label>
                     <label><input type=\"radio\" name=\"comeOrNot\" value=\"notComing\"> לא מגיע</label>";
    } else if ($eventObj->GetNotComingUsers() && in_array($userObj->GetId(), $eventObj->GetNotComingUsers())) {
        $radioBox = "<label><input type=\"radio\" name=\"comeOrNot\" value=\"coming\"> מגיע</label>
                     <label><input type=\"radio\" name=\"comeOrNot\" value=\"notComing\" checked=\"checked\"> לא מגיע</label>";
    } else {
        $radioBox = "<label><input type=\"radio\" name=\"comeOrNot\" value=\"coming\"> מגיע</label>
                     <label><input type=\"radio\" name=\"comeOrNot\" value=\"notComing\"> לא מגיע</label>";
    }
    \Services::setPlaceHolder($presents, "RadioBox", $radioBox);
    \Services::setPlaceHolder($pageTemplate, "PresentsUsers", $presents);
///////
    }
/////Admins Only
    if($userObj->GetRole()->getValue() >= 4) {
        $managerHTML = <<<ManageHTML
<div class="row">
        <div class="col-sm-12" style="padding: 0 25px">
            <h2>מנהלים בלבד:</h2>
            <button style='width: 100px; margin: 5px; 0' class='btn btn-warning btn-block' onclick="window.location='edit-event.php?EventId={$eventObj->GetId()}'">עריכה</button>
            <p><b>יוצר האירוע: </b>{$eventObj->GetOpenBy()->GetFullName()}</p>
            <p><b>תאריך פתיחה: </b>{$eventObj->GetOpenDate()->format("d/m/Y H:i ")}</p>
            <div class="col-sm-6 pull-right">
                <center><h3>מגיעים:</h3></center>
                <ul class="multi-column" style="list-style: none">
                    {ComingList}
                </ul>
            </div>
            <div class="col-sm-6">
                <center><h3>לא מגיעים:</h3></center>
                <ul class="multi-column" style="list-style: none">
                    {NotComingUsers}
                </ul>
            </div>
        </div>
</div> 
ManageHTML;

        if($eventObj->GetComingUsers()) {
            $comingList = "";
            foreach ($eventObj->GetComingUsers() as $comingUser) {
                $userInternalObj = User::GetById($comingUser);
                $comingList .= "<li><span class='glyphicon glyphicon-ok' style='color: green'></span> {$userInternalObj->GetFullName()}</li>";
            }
            \Services::setPlaceHolder($managerHTML, "ComingList", $comingList);
        }
        \Services::setPlaceHolder($managerHTML, "ComingList", "<h4>אין רשומות</h4>");

        if($eventObj->GetNotComingUsers()) {
            $notComingList = "";
            foreach ($eventObj->GetNotComingUsers() as $notComingUser) {
                $userInternalObj = User::GetById($notComingUser);
                $notComingList .= "<li><span class='glyphicon glyphicon-remove' style='color: darkred'></span> {$userInternalObj->GetFullName()}</li>";
            }
            \Services::setPlaceHolder($managerHTML, "NotComingUsers", $notComingList);
        }
        \Services::setPlaceHolder($managerHTML, "NotComingUsers", "<h4>אין רשומות</h4>");



        \Services::setPlaceHolder($pageTemplate, "ManagerHTML", $managerHTML);
    }
/////////////////
}

\Services::setPlaceHolder($pageTemplate, "PresentsUsers", "");
\Services::setPlaceHolder($pageTemplate, "ManagerHTML", "");
$pageTemplate .= footerTemplate;
echo $pageTemplate;
