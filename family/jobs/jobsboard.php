<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 01-Feb-18
 * Time: 12:56
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "לוח דרושים");
$pageTemplate .= bodyTemplate;


$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);

$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom8.jpg">
        </div>  
    </div>

    <div class="row" style="padding: 40px 0">
        <div class="col-sm-12">
            <h2 class="subtitles">לוח דרושים</h2>
        {JobsBigTable}
        </div>
    </div>
    <div class="row" style="padding: 40px 0">
        <div class="col-sm-12">
        <span><a style="margin-bottom: 50px; text-decoration: none;" href="https://845.co.il/family/jobs/addjob.php"><button class="btn btn-success btn-block">הוסף מודעה חדשה</button></a></span>
    </div>
    </div>

</div>
Index;

$allJobs = Rimon::GetDB()->where("Status",1)->get("jobs",null,"Id");
////////////Jobs Table///////////////
if(!empty($allJobs)) {
    $jobsTable = <<<EducationTable
{JobsTable}
EducationTable;

    $jobAllRows = <<<JobsTable
    <div class="row job-row">
        <div class="col-sm-2 pull-right">
            <img src="{jobIcon}">
        </div>
        <div class="col-xs-10 job-main pull-left">
            <div class="job-row-title"><a href="job.php?jobId={jobId}" target="_blank">{jobTitle}</a><span class="title-bold">{jobScope}</span></div>
            <p>
                {jobContent}
            </p>
            <div class="jobs-tags pull-right">
                <ul>
                    <li><span>היקף משרה: </span>{jobScope}</li>
                    <li><span>שכר: </span>{jobWage}</li>
                    <li><span>מיקום: </span>{jobLocation}</li>
                    <li>
                        <div class="pull-left jobs-more-info-btn">
                             <a href="job.php?jobId={jobId}" target="_blank"><button class="btn btn-success btn-block">עוד פרטים</button></a>
                        </div>
                    </li>
                    {editDeleteButtons}
                </ul>
            </div>
        </div>
    </div>
JobsTable;

    //////Delete Job(Change Status)////
    if(isset($_GET["DeleteJobId"])) {
        $jobObjDelete = Job::GetById($_GET["DeleteJobId"]);
        if($userObj->GetRole()->getValue() > 3 || $jobObjDelete->GetOpenBy()->GetId() == $userObj->GetId()){
            $jobObjDelete->Close();
            header("Location: jobsboard.php");
        }
    }
    /////////////////////

    $jobRow = "";
    foreach ($allJobs as $index => $job) {
        $jobObj = Job::GetById($job["Id"]);
        $jobRow .= $jobAllRows;
        if (array_key_exists($jobObj->GetStatus()->getValue(),Constant::JOBS_ICONS)) {
            \Services::setPlaceHolder($jobRow, "jobIcon", Constant::JOBS_ICONS[$jobObj->GetType()->getValue()]);
        }
        else {
            \Services::setPlaceHolder($jobRow, "jobIcon", Constant::JOBS_ICONS["default"]);
        }

        \Services::setPlaceHolder($jobRow, "jobType", $jobObj->GetType()->getDesc());
        \Services::setPlaceHolder($jobRow, "jobTitle", $jobObj->GetTitle());
        \Services::setPlaceHolder($jobRow, "jobWage", $jobObj->GetWage());
        \Services::setPlaceHolder($jobRow, "jobLocation", $jobObj->GetLocation());
        \Services::setPlaceHolder($jobRow, "jobScope", $jobObj->GetJobScope());
        \Services::setPlaceHolder($jobRow, "jobId", $jobObj->GetId());

        $shortContent = strlen($jobObj->GetContent()) > 400 ? substr($jobObj->GetContent(),0,400)."..." : $jobObj->GetContent();
        $shortContentNoHtml = strip_tags($shortContent);
        \Services::setPlaceHolder($jobRow, "jobContent", $shortContentNoHtml);

        //////Edit Button
        if($userObj->GetRole()->getValue() > 3 || $jobObj->GetOpenBy()->GetId() == $userObj->GetId()){
            $editDeleteButtons = "<li>
                        <div class=\"pull-left jobs-more-info-btn\" style=\"margin-left: 5px\">
                             <a href=\"editjob.php?JobId={$jobObj->GetId()}\"><button class=\"btn btn-warning btn-block\">ערוך</button></a>
                        </div>
                    </li>
                    <li>
                        <div class=\"pull-left jobs-more-info-btn\" style=\"margin-left: 5px\">
                             <a href=\"jobsboard.php?DeleteJobId={$jobObj->GetId()}\"><button class=\"btn btn-danger btn-block\">מחק</button></a>
                        </div>
                    </li>";
            \Services::setPlaceHolder($jobRow, "editDeleteButtons", $editDeleteButtons);
        } else
            \Services::setPlaceHolder($jobRow, "editDeleteButtons", "");
        ///

    }
    \Services::setPlaceHolder($jobsTable, "JobsTable", $jobRow);
    \Services::setPlaceHolder($pageTemplate, "JobsBigTable", $jobsTable);
} else {
    \Services::setPlaceHolder($pageTemplate, "JobsBigTable", "<center><h2>לא קיימות כרגע מודעות דרושים</h2></center>");
}
//////////////////////////////////////




$pageTemplate .= footerTemplate;
echo $pageTemplate;
