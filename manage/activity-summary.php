<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Feb-18
 * Time: 10:25
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "פעילות");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


if(!isset($_GET["activityId"]))
    \Services::RedirectHome();

$activityObj = ActivitySummary::GetById($_GET["activityId"]);

/////list of presents.
$presentsList = "";
foreach ($activityObj->GetPresents() as $present){
    $presentsList .= "<li>{$present->GetFullName()}</li>";
}
//////


$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom7.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <h2 class="subtitles">{$activityObj->GetSubject()}</h2>
            <button style="width: 150px; margin-bottom: 10px" class="btn btn-warning btn-block" onclick="window.location='https://845.co.il/manage/edit-activity-summary.php?SummaryId={$activityObj->GetId()}'">ערוך סיכום</button>
        </div>
    </div> 
    
    
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="row">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 pull-right">
                        <p>
                            <ul style="list-style: none;">
                                <li><b>סוג הפעילות:</b> {$activityObj->GetSubject()}.</li>
                                <li><b>נושא הפעילות:</b> {$activityObj->GetType()->getDesc()}.</li>   
                                <li><b>מיקום:</b> {$activityObj->GetLocation()}.</li> 
                            </ul>
                        </p> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                            <p><b>נוכחים:</b></p>
                            <ul class="multi-column">
                                {$presentsList}
                            </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 " style="margin: 0; padding: 0">
                        <p>
                            <h3>תוכן הפגישה:</h3>
                            {$activityObj->GetContent()}
                        </p>
                    </div>
                </div>       
                  
                   
            </div>
        </div>
    </div>
</div>
Index;



$pageTemplate .= footerTemplate;
echo $pageTemplate;
