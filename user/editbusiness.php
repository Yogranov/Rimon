<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 22-Jan-18
 * Time: 12:58
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "עריכת עסק");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);


$businessId = $_GET["id"];
$businessObj = Businesses::GetById($businessId);

if($businessObj->GetUserId() !== $userObj->GetId())
    \Services::RedirectHome();

if(isset($_POST["edit-user-form-business-submit"]) && Token::Check($_POST["edit-user-form-business-token"])){
    //business details
    $userBusinessName = $_POST["edit-user-form-business-name"];
    $userBusinessPhoneNumber = $_POST["edit-user-form-business-phone-number"];
    $userBusinessAbout = $_POST["edit-user-form-business-about"];

    //business address
    $userBusinessAddressPostalCode = $_POST["edit-user-form-postal-business-code"];
    $userBusinessAddressCityName = $_POST["edit-user-form-business-city-name"];
    $userBusinessAddressStreet = $_POST["edit-user-form-business-street"];
    $userBusinessAddressHouseNumber = $_POST["edit-user-form-business-house-number"];
    $userBusinessAddressApartmentNumber = $_POST["edit-user-form-business-apartments-number"];

    $arrayToUpdateBusiness = array("Name" => $userBusinessName,"PhoneNumber" => $userBusinessPhoneNumber, "About" => $userBusinessAbout);
    $arrayToUpdateBusinessAddress = array("PostalCode" => $userBusinessAddressPostalCode,"CityName" => $userBusinessAddressCityName, "Street" => $userBusinessAddressStreet, "HouseNumber" => $userBusinessAddressHouseNumber,"ApartmentNumber" => $userBusinessAddressApartmentNumber);


    $businessObj->Update($arrayToUpdateBusiness);
    $businessObj->GetAddress()->Update($arrayToUpdateBusinessAddress);

    //log
    $logString = "המשתמש {$userObj->GetFullName()} תז {$userObj->GetId()} ערך עסק מספר {$businessObj->GetId()}.";
    Rimon::NewLog($logString);

    header("Location: profile.php");

}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom3.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <h2 class="subtitles">פרופיל אישי - עריכת עסק</h2>
                        <button id="eduction-delete-button" onClick="deleteBusiness()" style="width: 150px" class="btn btn-danger btn-block">מחק עסק</button>

        </div>
    </div> 
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1" data-aos="zoom-in-up">
               <form method="post" role="form">
      
                   <h3>עסקים</h3>

                   <div class="col-sm-12">
                         <div class="form-group">
                              <label for="edit-user-form-business-name">שם העסק</label>
                              <input type="text" class="form-control" id="edit-user-form-business-name" value="{$businessObj->GetName()}" name="edit-user-form-business-name" placeholder="שם העסק">
                         </div>
                   </div>
                   
                   <h4>כתובת העסק</h4>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-postal-business-code">מיקוד</label>
                             <input type="text" class="form-control" id="edit-user-form-postal-business-code" value="{$businessObj->GetAddress()->GetPostalCode()}" name="edit-user-form-postal-business-code" placeholder="מיקוד" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-business-city-name">שם העיר</label>
                             <input type="text" class="form-control" id="edit-user-form-business-city-name" value="{$businessObj->GetAddress()->GetCityName()}" name="edit-user-form-business-city-name" placeholder="שם העיר/ישוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-business-street">רחוב</label>
                             <input type="text" class="form-control" id="edit-user-form-business-street" value="{$businessObj->GetAddress()->GetStreet()}" name="edit-user-form-business-street" placeholder="רחוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-business-house-number">מספר בניין</label>
                             <input type="text" class="form-control" id="edit-user-form-business-house-number" value="{$businessObj->GetAddress()->GetHouseNumber()}" name="edit-user-form-business-house-number" placeholder="מספר בניין">
                        </div>
                    </div>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-business-apartments-number">מספר דירה</label>
                             <input type="text" class="form-control" id="edit-user-form-business-apartments-number" value="{$businessObj->GetAddress()->GetApartmentNumber()}" name="edit-user-form-business-apartments-number" placeholder="מספר דירה">
                        </div>
                   </div>
                   
                  <div class="col-sm-12">
                        <div class="form-group">
                             <label for="edit-user-form-business-phone-number">מספר טלפון</label>
                             <input type="text" class="form-control" id="edit-user-form-business-phone-number" value="{$businessObj->GetPhoneNumber()}" name=edit-user-form-business-phone-number" placeholder="מספר טלפון">
                        </div>
                   </div>
                   
                 <div class="col-sm-12">
                      <div class="form-group">
                           <label for="edit-user-form-business-about">אודות העסק</label>
                           <input type="text" class="form-control" id="edit-user-form-business-about" value="{$businessObj->GetAbout()}" name="edit-user-form-business-about" placeholder="אודות העסק">
                      </div>
                 </div>

                    <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="שלח פרטים והמשך" name="edit-user-form-business-submit" class="btn btn-info btn-block">
                    </div>  
                    <input type="hidden" name="edit-user-form-business-token" value="{$token}">
               </form> 
        </div>
    </div>
</div>
<script>
function deleteBusiness() {
  if(confirm("אתה בטוח שאתה רוצה למחוק את {$businessObj->GetName()}?")){
      document.location = 'editbusiness.php?id={$businessObj->GetId()}&deleteid={$businessObj->GetId()}'
  }
}
</script>

Index;


/// Delete remind
if(isset($_GET['deleteid'])) {

    Businesses::GetById($_GET['deleteid'])->Delete();
    Address::GetById($businessObj->GetAddress()->GetId())->Delete();

    header("Location: profile.php");

}
/////


$pageTemplate .= footerTemplate;
echo $pageTemplate;
