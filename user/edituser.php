<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 22-Jan-18
 * Time: 11:25
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "עריכת פרופיל");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);



if(isset($_POST["edit-user-form-submit"]) && Token::Check($_POST["edit-user-form-token"])){

    //basic details
    $userPhoneNumber = $_POST["edit-user-form-phone-number"];
    $userEmail = $_POST["edit-user-form-email"];
    $userProfession = $_POST["edit-user-form-profession"];
    $userFacebook = $_POST["edit-user-facebook"];
    $userAbout = $_POST["edit-user-about"];

    //address
    $userAddressPostalCode = $_POST["edit-user-form-postal-code"];
    $userAddressCityName = $_POST["edit-user-form-city-name"];
    $userAddressStreet = $_POST["edit-user-form-street"];
    $userAddressHouseNumber = $_POST["edit-user-form-house-number"];
    $userAddressApartmentNumber = $_POST["edit-user-form-apartments-number"];


    $arrayToUpdateUser = array("Email" => $userEmail,"PhoneNumber" => $userPhoneNumber,"Profession" => $userProfession,"Facebook" => $userFacebook,"About" => $userAbout);
    $arrayToUpdateUserAddress = array("PostalCode" => $userAddressPostalCode,"CityName" => $userAddressCityName,"Street" => $userAddressStreet,"HouseNumber" => $userAddressHouseNumber,"ApartmentNumber" => $userAddressApartmentNumber);

    $userObj->Update($arrayToUpdateUser);
    $userObj->GetAddress()->Update($arrayToUpdateUserAddress);

    $logString = "המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> ערך את הפרופיל.";
    Rimon::NewLog($logString);
    header("Location: profile.php");

}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/desert-weapon.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <h2 class="subtitles">עריכת פרופיל אישי</h2>

        </div>
    </div> 
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1" data-aos="zoom-in-up">
               <form method="post" role="form">
               
                    <h3>פרטים בסיסים</h3>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-phone-number">מספר פלאפון</label>
                             <input type="text" class="form-control" id="edit-user-form-phone-number" value="{$userObj->GetPhoneNumber()}" name="edit-user-form-phone-number" placeholder="מספר פלאפון" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">    
                        <div class="form-group">
                             <label for="edit-user-form-email">אימייל</label>
                             <input type="text" class="form-control" id="edit-user-form-email" value="{$userObj->GetEmail()}" name="edit-user-form-email" placeholder="דואר אלקטרוני" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                          <div class="form-group">
                               <label for="edit-user-form-profession">מקצוע</label>
                               <input type="text" class="form-control" id="edit-user-form-profession" value="{$userObj->GetProfession()}" name="edit-user-form-profession" placeholder="מקצוע">
                          </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-facebook">פייסבוק</label>
                             <input type="text" class="form-control" id="edit-user-form-facebook" value="{$userObj->GetFacebook()}" name="edit-user-facebook" placeholder="פייסבוק">
                        </div>
                    </div>
                   
                 <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-user-form-about">על עצמי</label>
                          <input type="text" class="form-control" id="edit-user-form-about" value="{$userObj->GetAbout()}" name="edit-user-about" placeholder="על עצמי">
                     </div>
                 </div>
                    
                   <h3>כתובת</h3>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-postal-code">מיקוד</label>
                             <input type="text" class="form-control" id="edit-user-form-postal-code" value="{$userObj->GetAddress()->GetPostalCode()}" name="edit-user-form-postal-code" placeholder="מיקוד" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-city-name">שם העיר</label>
                             <input type="text" class="form-control" id="edit-user-form-city-name" value="{$userObj->GetAddress()->GetCityName()}" name="edit-user-form-city-name" placeholder="שם העיר/ישוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-street">רחוב</label>
                             <input type="text" class="form-control" id="edit-user-form-street" value="{$userObj->GetAddress()->GetStreet()}" name="edit-user-form-street" placeholder="רחוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-house-number">מספר בניין</label>
                             <input type="text" class="form-control" id="edit-user-form-house-number" value="{$userObj->GetAddress()->GetHouseNumber()}" name="edit-user-form-house-number" placeholder="מספר בניין">
                        </div>
                    </div>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-apartments-number">מספר דירה</label>
                             <input type="text" class="form-control" id="edit-user-form-apartments-number" value="{$userObj->GetAddress()->GetApartmentNumber()}" name="edit-user-form-apartments-number" placeholder="מספר דירה">
                        </div>
                   </div>
                   
                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="שלח פרטים והמשך" name="edit-user-form-submit" class="btn btn-info btn-block">
                    </div>  
                    <input type="hidden" name="edit-user-form-token" value="{$token}">
               </form> 
        </div>
    </div>
</div>

Index;


$MilitaryTypeString = "";
foreach (EMilitaryRoles::toArray() as $type) {
    $MilitaryTypeString .= "<option value='".$type[0]."' ";
    if ($userObj->GetMilitaryType()->getValue() == $type[0]){
        $MilitaryTypeString .= "selected='selected'";}
    $MilitaryTypeString .= ">".$type[1]."</option>";
}
\Services::setPlaceHolder($pageTemplate, "militaryType", $MilitaryTypeString);

$pageTemplate .= footerTemplate;
echo $pageTemplate;
