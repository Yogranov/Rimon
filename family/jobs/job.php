<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 02-Feb-18
 * Time: 18:14
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "מודעה");
$pageTemplate .= bodyTemplate;


$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


if(!isset($_GET["jobId"]))
    \Services::RedirectHome();


$jobObj = Job::GetById($_GET["jobId"]);



$pageTemplate .=
    <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom{$GLOBALS["RANDOM_PAGE_IMAGE"]}.jpg">
        </div>  
    </div>
    <div class="row" style="padding: 40px 0">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
                <div class="col-xs-6 pull-right">
                    <h3>פרטי המודעה</h3>
                    <ul style="list-style: none">
                        <li>שם המודעה: {$jobObj->GetTitle()}</li>
                        <li>מיקום: {$jobObj->GetLocation()}</li>
                        <li>שכר: {$jobObj->GetWage()}</li>
                        <li>היקף משרה: {$jobObj->GetJobScope()}</li>
                    </ul>
                </div>
            
                <div class="col-xs-6">
                    <h3>יצירת קשר</h3>
                    <ul style="list-style: none">
                        <li>איש קשר: {$jobObj->GetContactName()}</li>
                        <li>מספר טלפון: {$jobObj->GetContactPhoneNumber()}</li>
                        <li>דוא"ל: {$jobObj->GetContactEmail()}</li>
                        <li>אתר: {$jobObj->GetContactSite()}</li>
                        <li>פרטים נוספים: {$jobObj->GetContactOther()}</li>
                    </ul>
                </div>
            </div>
            <div class="row" style="margin-top: 50px">
                <div class="col-xs-12 pull-right">
                    {$jobObj->GetContent()}
                </div>
            </div>
        </div>
    </div>

</div>
Index;





$pageTemplate .= footerTemplate;
echo $pageTemplate;
