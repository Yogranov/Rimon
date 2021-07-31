<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 03-Feb-18
 * Time: 11:50
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הוספת עבודה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);

$error = "";
if(isset($_REQUEST["add-job-form-submit"])) {
    $title = $_REQUEST["add-job-form-title"];
    $content = $_REQUEST["add-job-form-content"];
    $jobScope = $_REQUEST["add-job-form-job-scope"];
    $openDate = new \DateTime('now',new \DateTimeZone('Asia/Jerusalem'));
    $jobFormType = $_REQUEST["add-job-form-type"];
    $location = $_REQUEST["add-job-form-location"];
    $wage = $_REQUEST["add-job-form-wage"];
    $contactName = $_REQUEST["add-job-form-contact-name"];
    $contactPhoneNumber = $_REQUEST["add-job-form-contact-phone-number"];
    $contactEmail = $_REQUEST["add-job-form-contact-email"];
    $contactSite = $_REQUEST["add-job-form-contact-site"];
    $contactOther = $_REQUEST["add-job-form-contact-other"];

    if(!empty($title) && !empty($content) && !empty($jobScope) && !empty($location) && !empty($contactName) && !empty($contactPhoneNumber)){
        try {
            $arrayToInsert = array("Title" => $title,
                "Content" => $content,
                "OpenDate" => $openDate->format("Y-m-d H:i:s"),
                "OpenBy" => $userObj->GetId(),
                "JobScope" => $jobScope,
                "Type" => $jobFormType,
                "Location" => $location,
                "Wage" => $wage,
                "Status" => 1,
                "ContactName" => $contactName,
                "ContactPhoneNumber" => $contactPhoneNumber,
                "ContactEmail" => $contactEmail,
                "ContactSite" => $contactSite,
                "ContactOther" => $contactOther
            );

            $newJob = Job::Add($arrayToInsert);
            TelegramBot::SendMessage(TelegramBot::rimonChannelId, "מודעת דרושים חדשה נוצרה! אולי היא תתאים לכם? https://845.co.il/family/jobs/job.php?jobId={$newJob->GetId()}");
            //log
            $logString = "עבודה ({$title}) חדשה נופסה על ידי המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
            Rimon::NewLog($logString);

            header("Location: jobsboard.php");
        } catch (\Throwable $e){
            $error = $e->getMessage();
        }

    } else{
        $error = "נא למלא את כל הפרטים הנדרשים";
    }

}



$pageTemplate .=
    <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom1.jpg">
        </div>  
    </div>
    <div class="row" style="padding: 40px 0">
        <div class="col-sm-10 col-sm-offset-1">
            <h2 class="subtitles">הוספת עבודה חדשה</h2>
            <p>{$error}</p>
            <form method="post" role="form"> 
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-title">כותרת</label>
                        <input type="text" class="form-control" id="add-job-form-title" name="add-job-form-title" placeholder="כותרת המודעה" required>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-job-scope">היקף המשרה</label>
                        <input type="text" class="form-control" id="add-job-form-job-scope" name="add-job-form-job-scope" placeholder="היקף המשרה" required>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>סוג המשרה:</label><br>
                        <select class="form-control" name="add-job-form-type">
                            {jobTypes}
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-location">מיקום</label>
                        <input type="text" class="form-control" id="add-job-form-location" name="add-job-form-location" placeholder="מיקום/כתובת המשרה" required>
                    </div>
                </div>                   
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-wage">שכר</label>
                        <input type="text" class="form-control" id="add-job-form-wage" name="add-job-form-wage" placeholder="שכר - ניתן לכתוב במטבעות שונים">
                    </div>
                </div>  
                
                <h3>פרטים ליצירת קשר</h3>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-contact-name">שם</label>
                        <input type="text" class="form-control" id="add-job-form-contact-name" name="add-job-form-contact-name" placeholder="שם האיש ליצירת קשר" required>
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-contact-phone-number">מספר טלפון</label>
                        <input type="text" class="form-control" id="add-job-form-contact-phone-number" name="add-job-form-contact-phone-number" placeholder="מספר טלפון" required>
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-contact-email">דוא"ל</label>
                        <input type="text" class="form-control" id="add-job-form-contact-email" name="add-job-form-contact-email" placeholder="דואר אלקטרוני">
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-contact-site">אתר</label>
                        <input type="text" class="form-control" id="add-job-form-contact-site" name="add-job-form-contact-site" placeholder="קישור לאתר או טופס הרשמה">
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-contact-other">אחר</label>
                        <input type="text" class="form-control" id="add-job-form-contact-other" name="add-job-form-contact-other" placeholder="פרטים אחרים">
                    </div>
                </div>  
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="add-job-form-content">תוכן המודעה</label>
                        <textarea id="add-job-form-content" name="add-job-form-content" class="form-control editarea" required>תוכן המודעה..</textarea>
                    </div>
                </div>
                
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                    <input type="submit" value="צור מודעה" name="add-job-form-submit" class="btn btn-info btn-block">
                </div>  
            </form> 
        </div>
    </div>

</div>
Index;

$jobTypes = "";
foreach (EjobType::toArray() as $jobType){
    $jobTypes .= "
        <option value=\"{$jobType[0]}\">$jobType[1]</option>
    ";
}
\Services::setPlaceHolder($pageTemplate,"jobTypes",$jobTypes);


$pageTemplate .= footerTemplate;
echo $pageTemplate;
