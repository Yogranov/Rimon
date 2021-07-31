<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 22:35
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "מסע עליה מרץ 16");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/march16.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">מסע עלייה למסלול מרץ 2/9/16</h2>   
                <p>צוות האח הגדול פתח את הבוקר עם הנעולים של צוות מרץ 16 שעלו היום למסלול!</p>
                <p>חברי העמותה עלו צפונה לפנות בוקר כדי להצטרף לצוות שסיים היום את החלק הבסיסי בהכשרתו, את פרק החי”ר. מהיום יתחילו את פרק ההכשרה של לוחם רימון.</p>
                <p>הנעולים הצעירים נתנו שם את כל כולם, ולא הפסיקו לרוץ לרגע. עמותת בוגרי רימון וחבריה מאחלים להם המון בהצלחה בהמשך, תנו בראש!</p>
                <p>אללללההההההה רימוןןןןןןןןןןןןןןןןןןן</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/march16.jpg">
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
