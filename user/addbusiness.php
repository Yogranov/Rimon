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
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הוספת עסק");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);



if(isset($_POST["add-user-form-business-submit"]) && Token::Check($_POST["add-user-form-business-token"])){
    //business details
    $userBusinessName = $_POST["add-user-form-business-name"];
    $userBusinessPhoneNumber = $_POST["add-user-form-business-phone-number"];
    $userBusinessAbout = $_POST["add-user-form-business-about"];

    //business address
    $userBusinessAddressPostalCode = $_POST["add-user-form-postal-business-code"];
    $userBusinessAddressCityName = $_POST["add-user-form-business-city-name"];
    $userBusinessAddressStreet = $_POST["add-user-form-business-street"];
    $userBusinessAddressHouseNumber = $_POST["add-user-form-business-house-number"];
    $userBusinessAddressApartmentNumber = $_POST["add-user-form-business-apartments-number"];

    $arrayToAddBusinessAddress = array("PostalCode" => $userBusinessAddressPostalCode,
                                        "CityName" => $userBusinessAddressCityName,
                                        "Street" => $userBusinessAddressStreet,
                                        "HouseNumber" => $userBusinessAddressHouseNumber,
                                        "ApartmentNumber" => $userBusinessAddressApartmentNumber);

    $newBusinessAddress = Address::Add($arrayToAddBusinessAddress);
    $arrayToAddBusiness = array("UserId" => $userObj->GetId(),
                                "Name" => $userBusinessName,
                                "Address" => $newBusinessAddress->GetId(),
                                "PhoneNumber" => $userBusinessPhoneNumber,
                                "About" => $userBusinessAbout);

    Businesses::Add($arrayToAddBusiness);

    //log
    $logString = "המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> הוסיף עסק חדש לפרופיל האישי.";
    Rimon::NewLog($logString);

    header("Location: profile.php");

}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/fire-range.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <h2 class="subtitles">פרופיל אישי - הוספת עסק</h2>
        </div>
    </div> 
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1" data-aos="zoom-in-up">
               <form method="post" role="form">
      
                   <h3>פרטי העסק</h3>

                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="add-user-form-business-name">שם העסק</label>
                              <input type="text" class="form-control" id="add-user-form-business-name" name="add-user-form-business-name" placeholder="שם העסק">
                         </div>
                   </div>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="add-user-form-business-phone-number">מספר טלפון</label>
                             <input type="text" class="form-control" id="add-user-form-business-phone-number" name="add-user-form-business-phone-number" placeholder="מספר טלפון">
                        </div>
                   </div>
                   
                   <div class="col-sm-12" style="padding-bottom: 30px">
                        <div class="form-group">
                             <label for="add-user-form-business-about">אודות העסק</label>
                             <input type="text" class="form-control" id="add-user-form-business-about" name="add-user-form-business-about" placeholder="אודות העסק">
                        </div>
                   </div>
                   
                   <h3>כתובת העסק</h3>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="add-user-form-postal-business-code">מיקוד</label>
                             <input type="text" class="form-control" id="add-user-form-postal-business-code" name="add-user-form-postal-business-code" placeholder="מיקוד" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="add-user-form-business-city-name">שם העיר</label>
                             <input type="text" class="form-control" id="add-user-form-business-city-name" name="add-user-form-business-city-name" placeholder="שם העיר/ישוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="add-user-form-business-street">רחוב</label>
                             <input type="text" class="form-control" id="add-user-form-business-street" name="add-user-form-business-street" placeholder="רחוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="add-user-form-business-house-number">מספר בניין</label>
                             <input type="text" class="form-control" id="add-user-form-business-house-number" name="add-user-form-business-house-number" placeholder="מספר בניין">
                        </div>
                    </div>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="add-user-form-business-apartments-number">מספר דירה</label>
                             <input type="text" class="form-control" id="add-user-form-business-apartments-number" name="add-user-form-business-apartments-number" placeholder="מספר דירה">
                        </div>
                   </div>

                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="שלח פרטים והמשך" name="add-user-form-business-submit" class="btn btn-info btn-block">
                    </div>  
                    <input type="hidden" name="add-user-form-business-token" value="{$token}">
               </form> 
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
