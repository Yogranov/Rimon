<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 22:54
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "סוף מסלול אוג 14");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/desert-weapon.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">סוף מסלול צוות אוג’ 14</h2>   
                <p>צוות “האח הגדול” של העמותה הגיע לטקס סוף מסלול של צוות הלוחמים של אוג’ 14, כדי לחלק חבילות שי לכבוד סוף מסלול.</p>
                <p>חבילות השי כללו ציוד חורף של: כובעי צמר, כפפות צמר וחם צוואר. אנחנו בטוחים שהם ימצאו להם שימוש בלילות המדבר המקפיאים או באימונים החורפיים בצפון.</p>
                <p>החבילות נתרמו ע”י “אדמה – מרכז הדרכה וציוד טיולים”. החנות נמצאת בחולון, רחוב הרב קוק 11.</p>
                <p>אין ספק שלאחר מסלול ארוך ומפרך שממשיך לתוך שירות מאתגר ומשמעותי, יש חשיבות 
                    רבה למתנות מסוג זה. העמותה שואפת לייצר מצב בו כל לוחם שמסיים מסלול מקבל חבילת שי מטעם העמותה, כי מגיע להם!
                </p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/od14-end-course.jpg">
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
