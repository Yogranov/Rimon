<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 22-Jan-18
 * Time: 22:09
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "פרופיל");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);


if(isset($_GET["userid"]) && $userObj->GetRole()->getValue() < 4)
    \Services::RedirectHome();

if(isset($_GET["userid"]) && $userObj->GetRole()->getValue() > 4) {
    $memberObj = User::GetById($_GET["userid"]);
    //log
    $logString = "המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> צפה בפרופיל של המשתמש <b>{$memberObj->GetFullName()}</b> תז <b>{$memberObj->GetId()}</b>";
    Rimon::NewLog($logString);
} else
        $memberObj = $userObj;

$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom1.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12">
            <h2 class="subtitles">פרופיל אישי</h2>
            {editDetails}

            <div class="col-sm-4 pull-right" style="font-size: 18px;">
                        <h3>פרטיים בסיסים</h3>
                  <ul style="list-style: none; width: 100%">
                        <li><b>תעודת זהות:</b> {$memberObj->GetId()}</li>
                        <li><b>שם פרטי:</b> {$memberObj->GetFirstName()}</li>
                        <li><b>שם משפחה:</b> {$memberObj->GetLastName()}</li>
                        <li><b>מספר פלאפון:</b> {$memberObj->GetPhoneNumber()}</li>
                        <li><b>מספר אישי:</b> {$memberObj->GetPersonalNumber()}</li>
                        <li><b>אימייל:</b> {$memberObj->GetEmail()}</li>
                        <li><b>תאריך לידה: </b>{$memberObj->GetBirthday()->format("d/m/Y")}</li>
                        <li><b>מקצוע:</b> {$memberObj->GetProfession()}</li>
                        <li><b>פייסבוק:</b> {facebookURL}</li>
                        <li><b>על עצמי:</b> {$memberObj->GetAbout()}</li>
                  </ul>
            </div>
            <div class="col-sm-4 pull-right" style="font-size: 18px">
                        <h3>כתובת מגורים</h3>
                   <ul style="list-style: none; width: 100%"> 
                        <li><b>מיקוד:</b> {$memberObj->GetAddress()->GetPostalCode()}</li>
                        <li><b>שם העיר:</b> {$memberObj->GetAddress()->GetCityName()}</li>
                        <li><b>רחוב:</b> {$memberObj->GetAddress()->GetStreet()}</li>
                        <li><b>מספר בניין:</b> {$memberObj->GetAddress()->GetHouseNumber()}</li>
                        <li><b>מספר דירה:</b> {$memberObj->GetAddress()->GetApartmentNumber()}</li>
                   </ul>
            </div>
            <div class="col-sm-4 pull-right" style="font-size: 18px">
                        <h3>שירות צבאי</h3>
                   <ul style="list-style: none; width: 100%"> 
                         <li><b>תפקיד בשירות:</b> {$memberObj->GetMilitaryType()->getDesc()}</li>
                         <li><b>תאריך גיוס:</b> {$memberObj->GetRecruitment()->format("d/m/y")}</li>
                   </ul> 
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-sm-2 pull-right">
            {addBusiness}
        </div>
        <div class="col-sm-2 pull-right">
            {addEducation}   
        </div>
    </div>
        {EducationBigTable}
    
        {BusinessesBigTable}
</div>
Index;
////////////Education Table///////////////
if(!empty($memberObj->GetEducation())) {
    $educationTable = <<<EducationTable
    <div class="row profile-tables">
        <div class="col-sm-10 col-sm-offset-1">
            <h3>השכלה</h3>
            {pressHereToEdit}
            <table class="table">
                <thead>
                  <tr>
                    <th>סוג הלימודים</th>
                    <th>שנות לימוד</th>
                    <th>שם המקצוע</th>
                    <th>שם המוסד</th>
                  </tr>
                </thead>
                <tbody>
                    {EducationTable}
                </tbody>
              </table>
        </div>
    </div>
EducationTable;


    $educationAllRows = <<<EducationTable
<tr {editRow}>
    <td>{EducationType}</td>
    <td>{EducationYears}</td>
    <td>{EducationName}</td>
    <td>{EducationInstitute}</td>
</tr>
EducationTable;

    $educationRow = "";
    foreach ($memberObj->GetEducation() as $education) {
        $educationRow .= $educationAllRows;
        if(!isset($_GET["userid"])){
            \Services::setPlaceHolder($educationRow,"editRow","onclick=\"document.location = 'editeducation.php?id={EducationId}';\" style=\"cursor: pointer\"");
        } else{
            \Services::setPlaceHolder($educationRow,"editRow","");
        }

        \Services::setPlaceHolder($educationRow, "EducationType", $education->GetType()->getDesc());
        \Services::setPlaceHolder($educationRow, "EducationYears", $education->GetYears());
        \Services::setPlaceHolder($educationRow, "EducationName", $education->GetName());
        \Services::setPlaceHolder($educationRow, "EducationInstitute", $education->GetInstitute());
        \Services::setPlaceHolder($educationRow, "EducationId", $education->GetId());
    }
    \Services::setPlaceHolder($educationTable, "EducationTable", $educationRow);
    \Services::setPlaceHolder($pageTemplate, "EducationBigTable", $educationTable);

} else {
    \Services::setPlaceHolder($pageTemplate, "EducationBigTable", "");
}
//////////////////////////////////////



///////////////////// Businesses Table //////////////////
if(!empty($memberObj->GetBusinesses())) {
    $businessnTable = <<<BusinessTable

<div class="row profile-tables">
        <div class="col-sm-10 col-sm-offset-1">
            <h3>עסקים</h3>
            {pressHereToEdit}
            <table class="table table">
                <thead>
                  <tr>
                    <th>שם העסק</th>
                    <th>כתובת</th>
                    <th>מספר טלפון</th>
                    <th>על העסק</th>
                  </tr>
                </thead>
                <tbody>
                    {BusinessesTable}
                </tbody>
              </table>
        </div>
    </div>
BusinessTable;

    $businessesAllRows = <<<BusinessesTable
<tr {editRow}>
    <td>{BusinessName}</td>
    <td>{BusinessAddress}</td>
    <td>{BusinessPhoneNumber}</td>
    <td>{BusinessAbout}</td>
</tr>
BusinessesTable;

    $businessRow = "";
    foreach ($memberObj->GetBusinesses() as $business) {
        $businessRow .= $businessesAllRows;
        if(!isset($_GET["userid"])){
            \Services::setPlaceHolder($businessRow,"editRow","onclick=\"document.location = 'editbusiness.php?id={BusinessId}';\" style=\"cursor: pointer\"");
        } else{
            \Services::setPlaceHolder($businessRow,"editRow","");
        }
        \Services::setPlaceHolder($businessRow, "BusinessName", $business->GetName());
        \Services::setPlaceHolder($businessRow, "BusinessPhoneNumber", $business->GetPhoneNumber());
        \Services::setPlaceHolder($businessRow, "BusinessAbout", $business->GetAbout());
        \Services::setPlaceHolder($businessRow, "BusinessId", $business->GetId());
        $businessAddress = "{$business->GetAddress()->GetStreet()} {$business->GetAddress()->GetHouseNumber()}, {$business->GetAddress()->GetCityName()}, {$business->GetAddress()->GetPostalCode()}";
        \Services::setPlaceHolder($businessRow, "BusinessAddress", $businessAddress);
    }
    \Services::setPlaceHolder($businessnTable, "BusinessesTable", $businessRow);
    \Services::setPlaceHolder($pageTemplate, "BusinessesBigTable", $businessnTable);
} else {
    \Services::setPlaceHolder($pageTemplate, "BusinessesBigTable", "");

}
//////////////////////////////


///facebook set exists
if(!empty($memberObj->GetFacebook()))
    \Services::setPlaceHolder($pageTemplate,"facebookURL", "<a href='{$memberObj->GetFacebook()}' target='_blank'>קישור</a>");
    else
    \Services::setPlaceHolder($pageTemplate,"facebookURL", 'לא הוזן.');

/////



//////// buttons set /////
if(!isset($_GET["userid"])){
    \Services::setPlaceHolder($pageTemplate,"editDetails","<button style='width: 150px' class='btn btn-warning btn-block' onclick=\"window.location='edituser.php'\">עריכת פרטים</button>");
    \Services::setPlaceHolder($pageTemplate,"addBusiness","<a style=\"padding: 0; text-decoration: none;\" href=\"addbusiness.php\"><button style=\"width: 100%\" class=\"btn btn-primary btn-block\">הוסף עסק</button></a>");
    \Services::setPlaceHolder($pageTemplate,"addEducation","<a style=\"padding: 0; text-decoration: none;\" href=\"addeducation.php\"><button style=\"width: 100%\" class=\"btn btn-primary btn-block\">הוסף השכלה</button></a>");
    \Services::setPlaceHolder($pageTemplate,"pressHereToEdit","<h5>*לחץ על הטבלה לעריכה*</h5>");
    \Services::setPlaceHolder($pageTemplate,"pressHereToEdit","<h5>*לחץ על הטבלה לעריכה*</h5>");
} else {
    \Services::setPlaceHolder($pageTemplate,"editDetails","");
    \Services::setPlaceHolder($pageTemplate,"addBusiness","");
    \Services::setPlaceHolder($pageTemplate,"addEducation","");
    \Services::setPlaceHolder($pageTemplate,"pressHereToEdit","");
    \Services::setPlaceHolder($pageTemplate,"pressHereToEdit","");
}
//////////////////


$pageTemplate .= footerTemplate;
echo $pageTemplate;
