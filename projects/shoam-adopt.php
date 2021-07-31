<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 04-Feb-18
 * Time: 14:10
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "שהם מאמצת את היחידה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/shoam-adopt.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">שוהם מאמצת את היחידה</h2>   
                <p>מהיום זה כבר רשמי, מועצת שוהם וראש המועצה מר גיל ליבנה, יחד עם האגודה למען החייל שוהם, החליטו לאמץ את עמותת בוגרי רימון!</p>
                <p>בהמשך לשיתוף הפעולה המתקיים בין מועצת שוהם לבין העמותה מאז מרוץ רימון ה-1, החליטו שני הצדדים להעלות הילוך. מהיום מועצת שוהם וסניף האגודה למען החייל בשוהם, יתמכו באופן רשמי בפעילויות העמותה למען משרתי היחידה ובוגריה!</p>
                <p>אין לנו ספק שזאת תחילתה של תקופת פריחה ושגשוג, ואיזו דרך יותר טובה מלהתחיל אותה בערב יחידה לכבוד חג החנוכה :)</p>
                <p>חג שמח.</p>
                <p>עמותת רימון – עמותה שהיא משפחה</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/shoam-adopt.jpg">
            </div>
        </div>
    </div>
    
       
            
            </div>
        </div>
    
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
