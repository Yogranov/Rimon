<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 22-Feb-18
 * Time: 09:11
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "מסע עליה צוות אלקבץ");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/alkabetz-journey.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">מסע סוף מסלול - צוות אלקבץ</h2>   
                <br>
                <p>חברי העמותה עלו צפונה לפתוח את סוף השבוע עם הלוחמים הנעולים שסיימו את המסלול - צוות אלקבץ!</p>
                <p>חברי העמותה חברו את הלוחמים בחלקו האחרון של המסע והראו להם שגם אחרי המסלול והשירות, כולנו משפחה אחת.</p>
                <p>לאחר המסע התכנסו החיילים וחברי העמותה לארוחת צהרים וטקס סוף המסלול, בו הלוחמים מקבלים את סיכת הלוחם ורשמית הופכים ללוחמים ביחידה.</p>
                <p>אנו רוצים להודות לצוות האח הגדול שהגיע עד לכתף שאול, וגם שמו כתף באלונקה.</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/alkabetz-journey.jpg">
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
