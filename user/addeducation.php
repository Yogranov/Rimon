<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 24-Jan-18
 * Time: 20:57
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הוספת השכלה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);

if(isset($_POST["add-user-form-education-submit"]) && Token::Check($_POST["add-user-form-education-token"])) {

    //education details
    $userEducationYears = $_POST["add-user-form-education-years"];
    $userEducationName = $_POST["add-user-form-education-name"];
    $userEducationInstitute = $_POST["add-user-form-education-institute"];
    $userEducationType = $_POST["add-user-form-education-type"];

    $arrayToAddEducation = array("UserId" => $userObj->GetId(),"Type" => $userEducationType, "Years" => $userEducationYears,"Name" => $userEducationName, "Institute" => $userEducationInstitute);
    Education::Add($arrayToAddEducation);

    //log
    $logString = "המשתמש {$userObj->GetFullName()} תז {$userObj->GetId()} הוסיף השכלה חדשה לפרופיל האישי.";
    Rimon::NewLog($logString);

    header("Location: profile.php");

}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom5.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <h2 class="subtitles">עריכת פרופיל אישי - הוספת השכלה</h2>
        </div>
    </div> 
    
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1" data-aos="zoom-in-up">
               <form method="post" role="form"> 
               
                   <div class="col-sm-12">
                        <div class="form-group">
                            <p><b>סוג השכלה</b></p>
                            <select class="form-control" name="add-user-form-education-type">
                                {EducationTypes}
                            </select>
                        </div>
                   </div>
                  
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="add-user-form-education-years">מספר שנות לימוד</label>
                              <input type="number" class="form-control" id="add-user-form-education-years" name="add-user-form-education-years" placeholder="מספר שנות לימוד">
                         </div>
                   </div>
                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="add-user-form-education-name">שם המקצוע</label>
                              <input type="text" class="form-control" id="add-user-form-education-name" name="add-user-form-education-name" placeholder="שם המקצוע">
                         </div>
                   </div>
                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="add-user-form-education-institute">שם המוסד</label>
                              <input type="text" class="form-control" id="add-user-form-education-institute" name="add-user-form-education-institute" placeholder="שם המוסד">
                         </div>
                   </div>                   
                   
                   
                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="שלח פרטים והמשך" name="add-user-form-education-submit" class="btn btn-info btn-block">
                    </div>  
                    <input type="hidden" name="add-user-form-education-token" value="{$token}">
               </form> 
        </div>
    </div>
</div>
Index;


$EducationTypes = "";
foreach (EEducationTypes::toArray() as $EducationType){
    $EducationTypes .= "
        <option value='{$EducationType[0]}'>$EducationType[1]</option>
    ";
}
\Services::setPlaceHolder($pageTemplate,"EducationTypes",$EducationTypes);


$pageTemplate .= footerTemplate;
echo $pageTemplate;
