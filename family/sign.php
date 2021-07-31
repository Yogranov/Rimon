<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 29-Jan-18
 * Time: 10:12
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "תרום לעמותה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$userObj = User::GetById($_SESSION["UserId"]);
$time = new \DateTime('now',new \DateTimeZone(Constant::SYSTEM_TIMEZONE));

$pageTemplate .=
    <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/handshake.jpg">
        </div>  
    </div>

    <div class="row" style="padding: 40px 0">
        <div class="col-sm-7 pull-right">
            <h2 class="subtitles">אישור חברות בעמותה</h2>
            <p>
                וזאת לראיה כי - <br>
                <ul>
                    <li>שם: {$userObj->GetFullName()}</li>
                    <li>מספר ת"ז: {$userObj->GetId()}</li>
                </ul>
                <p>הינו <b>חבר בעמותת בוגרי רימון</b> נכון לתאריך - {$time->format("d/m/y")} </p>
                <p>חותמת זמן - <b><span class="clock"></span></b></p>
                
            </p>
             <br>
            <p>
                אסמכתא זו מהווה אישור רשמי לחברות בעמותת בוגרי רימון. <br>
                אישור זה הינו כחותמת רשמית לזכאות לכלל ההטבות הבלעדיות לחברי העמותה.     
            </p>
            <p>
                בכבוד רב, <br>
                הנהלת עמותת בוגרי רימון.
            </p>
        
                    <img src="../media/random/Amuta%20sign.png" style="width: 70%">

        </div>
        <div class="col-sm-5">
            <img src="../media/random/security-lock.png" style="width: 100%">
        </div>
    </div>
   

</div>
<script>
function clock() {
var time = new Date(),
    hours = time.getHours(),
    minutes = time.getMinutes(),
    seconds = time.getSeconds();
document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
  function harold(standIn) {
    if (standIn < 10) {
      standIn = '0' + standIn
    }
    return standIn;
  }
}
setInterval(clock, 1000);
</script>
Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
