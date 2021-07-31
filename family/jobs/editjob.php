<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 20-Feb-18
 * Time: 21:03
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "עריכת משרה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$jobId = $_GET["JobId"];
try{
    $jobObj = Job::GetById($jobId);
} catch (\Throwable $e){
    \Services::RedirectHome();
}

$userObj = User::GetById($_SESSION["UserId"]);
if(!($userObj->GetRole()->getValue() > 3) && !($jobObj->GetOpenBy()->GetId() == $userObj->GetId()))
    \Services::RedirectHome();

$error = "";
if(isset($_REQUEST["edit-job-form-submit"])) {
    $title = $_REQUEST["edit-job-form-title"];
    $content = $_REQUEST["edit-job-form-content"];
    $jobScope = $_REQUEST["edit-job-form-job-scope"];
    $jobFormType = $_REQUEST["edit-job-form-type"];
    $location = $_REQUEST["edit-job-form-location"];
    $wage = $_REQUEST["edit-job-form-wage"];
    $contactName = $_REQUEST["edit-job-form-contact-name"];
    $contactPhoneNumber = $_REQUEST["edit-job-form-contact-phone-number"];
    $contactEmail = $_REQUEST["edit-job-form-contact-email"];
    $contactSite = $_REQUEST["edit-job-form-contact-site"];
    $contactOther = $_REQUEST["edit-job-form-contact-other"];

    if(!empty($title) && !empty($content) && !empty($jobScope) && !empty($location) && !empty($contactName) && !empty($contactPhoneNumber)){
        try {
            $arrayToInsert = array("Title" => $title,
                "Content" => $content,
                "JobScope" => $jobScope,
                "Type" => $jobFormType,
                "Location" => $location,
                "Wage" => $wage,
                "ContactName" => $contactName,
                "ContactPhoneNumber" => $contactPhoneNumber,
                "ContactEmail" => $contactEmail,
                "ContactSite" => $contactSite,
                "ContactOther" => $contactOther
            );
            $jobObj->Update($arrayToInsert);

            //log
            $logString = "עבודה מספר <b>{$jobObj->GetId()}</b> נערכה על ידי <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
            Rimon::NewLog($logString);

            header("Location: jobsboard.php");
        } catch (\Throwable $e){
            $error = $e->getMessage();
        }

    } else{
        $error = "נא למלא את כל הפרטים הנדרשים";
    }

}



$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom1.jpg">
        </div>  
    </div>
    <div class="row" style="padding: 40px 0">
        <div class="col-sm-10 col-sm-offset-1">
            <h2 class="subtitles">עריכת משרה</h2>
            <p>{$error}</p>
            <form method="post" role="form"> 
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-title">כותרת</label>
                        <input type="text" class="form-control" id="edit-job-form-title" name="edit-job-form-title" value="{$jobObj->GetTitle()}" required>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-job-scope">היקף המשרה</label>
                        <input type="text" class="form-control" id="edit-job-form-job-scope" name="edit-job-form-job-scope" value="{$jobObj->GetJobScope()}" required>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>סוג המשרה:</label><br>
                        <select class="form-control" name="edit-job-form-type">
                            {jobTypes}
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-location">מיקום</label>
                        <input type="text" class="form-control" id="edit-job-form-location" name="edit-job-form-location" value="{$jobObj->GetLocation()}" required>
                    </div>
                </div>                   
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-wage">שכר</label>
                        <input type="text" class="form-control" id="edit-job-form-wage" name="edit-job-form-wage" value="{$jobObj->GetWage()}">
                    </div>
                </div>  
                
                <h3>פרטים ליצירת קשר</h3>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-contact-name">שם</label>
                        <input type="text" class="form-control" id="edit-job-form-contact-name" name="edit-job-form-contact-name"  value="{$jobObj->GetContactName()}" required>
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-contact-phone-number">מספר טלפון</label>
                        <input type="text" class="form-control" id="edit-job-form-contact-phone-number" name="edit-job-form-contact-phone-number"  value="{$jobObj->GetContactPhoneNumber()}" required>
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-contact-email">דוא"ל</label>
                        <input type="text" class="form-control" id="edit-job-form-contact-email" name="edit-job-form-contact-email"  value="{$jobObj->GetContactEmail()}">
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-contact-site">אתר</label>
                        <input type="text" class="form-control" id="edit-job-form-contact-site" name="edit-job-form-contact-site"  value="{$jobObj->GetContactSite()}">
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-contact-other">אחר</label>
                        <input type="text" class="form-control" id="edit-job-form-contact-other" name="edit-job-form-contact-other"  value="{$jobObj->GetContactOther()}">
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="edit-job-form-content">תוכן המודעה</label>
                        <textarea id="edit-job-form-content" name="edit-job-form-content" class="form-control editarea" required>{$jobObj->GetContent()}</textarea>
                    </div>
                </div>
                
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                    <input type="submit" value="עדכן מודעה" name="edit-job-form-submit" class="btn btn-info btn-block">
                </div>  
            </form> 
        </div>
    </div>

</div>
Index;


$jobTypes = "";
foreach (EjobType::toArray() as $type) {
    $jobTypes .= "<option value='".$type[0]."' ";
    if ($jobObj->GetType()->getValue() == $type[0]){
        $jobTypes .= "selected='selected'";}
    $jobTypes .= ">".$type[1]."</option>";
}
\Services::setPlaceHolder($pageTemplate, "jobTypes", $jobTypes);


$pageTemplate .= footerTemplate;
echo $pageTemplate;
