<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 22-Jan-18
 * Time: 12:57
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "עריכת השכלה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);


$educationId = $_GET["id"];
$educationObj = Education::GetById($educationId);

if($educationObj->GetUserId() !== $userObj->GetId())
    \Services::RedirectHome();


if(isset($_POST["edit-user-form-education-submit"]) && Token::Check($_POST["edit-user-form-education-token"])) {

    //education details
    $userEducationYears = $_POST["edit-user-form-education-years"];
    $userEducationName = $_POST["edit-user-form-education-name"];
    $userEducationInstitute = $_POST["edit-user-form-education-institute"];
    $userEducationType = $_POST["edit-user-form-education-type"];

    $arrayToUpdateEducation = array("Type" => $userEducationType, "Years" => $userEducationYears,"Name" => $userEducationName, "Institute" => $userEducationInstitute);
    $educationObj->Update($arrayToUpdateEducation);

    //log
    $logString = "המשתמש {$userObj->GetFullName()} תז {$userObj->GetId()} ערך השכלה מספר {$educationObj->GetId()}.";
    Rimon::NewLog($logString);

    header("Location: profile.php");

}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom4.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <h2 class="subtitles">עריכת פרופיל אישי - השכלה</h2>
            <button id="eduction-delete-button" onClick="deleteEducation()" style="width: 150px" class="btn btn-danger btn-block">מחק השכלה</button>

        </div>
    </div> 
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1" data-aos="zoom-in-up">
               <form method="post" role="form">                   
                   <p>סוג השכלה</p>
                    <select class="form-control" name="edit-user-form-education-type">
                        {educationType}
                    </select>
                  
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-user-form-education-years">מספר שנות לימוד</label>
                              <input type="text" class="form-control" id="edit-user-form-education-years" value="{$educationObj->GetYears()}" name="edit-user-form-education-years" placeholder="מספר שנות לימוד">
                         </div>
                   </div>
                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-user-form-education-name">שם המקצוע</label>
                              <input type="text" class="form-control" id="edit-user-form-education-name" value="{$educationObj->GetName()}" name="edit-user-form-education-name" placeholder="שם המקצוע">
                         </div>
                   </div>
                   
                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-user-form-education-institute">שם המוסד</label>
                              <input type="text" class="form-control" id="edit-user-form-education-institute" value="{$educationObj->GetInstitute()}" name="edit-user-form-education-institute" placeholder="שם המוסד">
                         </div>
                   </div>                   
                   
                   
                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="שלח פרטים והמשך" name="edit-user-form-education-submit" class="btn btn-info btn-block">
                    </div>  
                    <input type="hidden" name="edit-user-form-education-token" value="{$token}">
               </form> 
        </div>
    </div>
</div>

<script>
function deleteEducation() {
  if(confirm("אתה בטוח שאתה רוצה למחוק את {$educationObj->GetName()}?")){
      document.location = 'editeducation.php?id={$educationObj->GetId()}&deleteid={$educationObj->GetId()}'
  }
}
</script>

Index;


$EducationTypeString = "";
foreach (EEducationTypes::toArray() as $type) {
    $EducationTypeString .= "<option value='".$type[0]."' ";
    if ($educationObj->GetType()->getValue() == $type[0]){
        $EducationTypeString .= "selected='selected'";}
    $EducationTypeString .= ">".$type[1]."</option>";
}
\Services::setPlaceHolder($pageTemplate, "educationType", $EducationTypeString);



/// Delete remind
if(isset($_GET['deleteid'])) {

    Education::GetById($_GET['deleteid'])->Delete();
    header("Location: profile.php");

}
/////



$pageTemplate .= footerTemplate;
echo $pageTemplate;
