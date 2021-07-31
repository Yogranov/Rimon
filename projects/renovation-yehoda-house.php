<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 22:38
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "שיפות ביתו של יהודה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/yehoda-race.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">התנדבות בשיפוץ ביתו של יהודה הישראלי</h2>   
                <p>תותחים!</p>
                <p>אתמול הגיעה קבוצה גדולה של חברי העמותה לביתו של אחינו יהודה הישראלי, כדי לסייע בשיפוץ הבית בעופרה ובהתאמתו לצרכיו החדשים של יהודה.</p>
                <p>החברה הצטרפו למנהל הפרויקט רם בירן (שהיה מפקד הצוות של יהודה בזמן שנפצע ב”צוק איתן”) בסחיבות, הרמות, דפיקות, קדיחות ועוד. לא היו שם דברים שיותר קשים מסחיבת פצוע או אימון קרב מגע.</p>
                <p>“נתנו עבודה חבל על הזמן!!!” סיפר לנו רם בהתלהבות.</p>
                <p>חלק לקחו חופש מהעבודה, חלק כבר היו בזמן חופשה, וחלק הגיעו בין זה לבין זה. כל אחד מהם, על חשבון סדר העדיפויות האישי שלו, בחר ביהודה.</p>
                <p>אחים לנשק ואחים לחיים, ישר כח חברים!</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/yehoda.jpg">
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
