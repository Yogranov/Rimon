<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 22:44
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "ביקור בקורס צלפים");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/fire-range.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">צוות “האח הגדול” מבקר באימון צלפים</h2>   
                <p>צוות “האח הגדול” השקים קום ויצא לבקר הבוקר את צלפי היחידה שביצעו אימון במרכז הארץ. פתחנו את הבוקר במד”ס 6 קל (לא בטוח שלאזרחים מביננו היה קל 😉 ), ומשם המשכנו לארוחת בוקר של לוחמים.</p>
                <p>נציגי העמותה התעדכנו עם הלוחמים בדברים שקורים כיום ביחידה, וכמובן של- “צעירים” שבקבוצה יצא קצת לשמוע על חוויות העבר של נציגי העמותה!</p>
                <p>תודה לראש צוות “האח הגדול” אברהם סלה, דור מואס ועמית הרוש, שארגנו את היום הזה!</p>
                <p>אין כמו לשבור קצת שיגרה בין מטווח למטווח! מקוום שנהניתם 🙂</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/big-brother-sniper-train.jpg">
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
