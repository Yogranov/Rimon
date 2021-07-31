<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 22-Jan-18
 * Time: 10:41
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "השלמת פרטים");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);


//check personalNumber And Recruitment
$userObj = User::GetById($_SESSION["UserId"]);
$info = Rimon::GetDB()->where("Id",$userObj->GetId())->getOne("users","PersonalNumber");
$recruitmentDate = Rimon::GetDB()->where("Id",$userObj->GetId())->getOne("users","Recruitment");

if($info["PersonalNumber"] > 1 && $recruitmentDate["Recruitment"] != null)
    header("Location: main.php");



if(isset($_POST["complete-details-form-submit"])) {
    $arrayToUpdate = array("PersonalNumber" => $_POST["complete-details-form-personal-number"], "Recruitment" => $_POST["complete-details-form-recruitment"]);
    Rimon::GetDB()->where("Id", $userObj->GetId())->update("users", $arrayToUpdate);

    //log
    $logString = "המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> השלים את הפרטים: מספר אישי ותאריך גיוס.";
    Rimon::NewLog($logString);

    header("Location: main.php");
}

$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/projects-race-1.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <h2 class="subtitles">השלמת פרטים</h2>
            <p>היי אחים ואחיות!</p>
            <p> אם הגעתם לפה, כנראה שחסרים לנו מספר פרטים עליכם. לאחר השלמת הפרטים תוכלו לחזור ולהנות מהתוכן הבלעדי שלנו.</p>
            <p>תודה!</p>
        </div>
    </div> 
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1" data-aos="zoom-in-up">
               <form method="post" role="form">
                     <div class="col-sm-12">
                        <div class="form-group">
                             <label for="complete-details-form-personal-number">מספר אישי</label>
                             <input type="text" class="form-control" id="complete-details-form-personal-number" name="complete-details-form-personal-number" placeholder="מספר אישי של הצבא" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                          <div class="form-group">
                               <label for="complete-details-form-recruitment">תאריך גיוס</label>
                               <input type="date" style="text-align: right" class="form-control" id="complete-details-form-recruitment" name="complete-details-form-recruitment" placeholder="תאריך גיוס">
                          </div>
                    </div>

                   
                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="שלח פרטים והמשך" name="complete-details-form-submit" class="btn btn-info btn-block">
                    </div>  
                    
               </form> 
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
