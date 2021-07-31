<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 27-Jan-18
 * Time: 11:50
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הרשמה לעמותה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$errorMsg = "";
if(isset($_POST["new-user-form-submit"]) && Token::Check($_POST["new-user-form-token"])){

    $secretKey = Constant::GOOGLE_RECAPTCHA_SECRET_KEY;
    $responseKey = $_POST["g-recaptcha-response"];
    $userIp = $_SERVER["REMOTE_ADDR"];
    $request_url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIp";
    $ch = curl_init($request_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($ch));

    if($response->success) {
        //basic details
        $userId = Rimon::GetDB()->escape($_POST["new-user-form-id"]);
        $userPassword = Rimon::GetDB()->escape($_POST["new-user-form-password"]);
        $userPasswordAgain = Rimon::GetDB()->escape($_POST["new-user-form-password-again"]);
        $userFirstName = Rimon::GetDB()->escape($_POST["new-user-form-first-name"]);
        $userLastName = Rimon::GetDB()->escape($_POST["new-user-form-last-name"]);
        $userPhoneNumber = Rimon::GetDB()->escape($_POST["new-user-form-phone-number"]);
        $userPersonalNumber = Rimon::GetDB()->escape($_POST["new-user-form-personal-number"]);
        $userEmail = Rimon::GetDB()->escape($_POST["new-user-form-email"]);
        $userEmailAgain = Rimon::GetDB()->escape($_POST["new-user-form-email-again"]);
        $userBirthday = Rimon::GetDB()->escape($_POST["new-user-form-birthday"]);
        $userProfession = Rimon::GetDB()->escape($_POST["new-user-form-profession"]);
        $userFacebook = Rimon::GetDB()->escape($_POST["new-user-facebook"]);
        $userAbout = Rimon::GetDB()->escape($_POST["new-user-about"]);

        //military service
        $userMilitaryType = Rimon::GetDB()->escape($_POST["new-user-form-military-type"]);
        $userRecruitment = Rimon::GetDB()->escape($_POST["new-user-form-recruitment"]);

        //address
        $userAddressPostalCode = Rimon::GetDB()->escape($_POST["new-user-form-postal-code"]);
        $userAddressCityName = Rimon::GetDB()->escape($_POST["new-user-form-city-name"]);
        $userAddressStreet = Rimon::GetDB()->escape($_POST["new-user-form-street"]);
        $userAddressHouseNumber = Rimon::GetDB()->escape($_POST["new-user-form-house-number"]);
        $userAddressApartmentNumber = Rimon::GetDB()->escape($_POST["new-user-form-apartments-number"]);

        $passwordHasher = new PasswordHash(16, true);
        $passwordConverted = $passwordHasher->HashPassword($userPassword);
        $time = new \DateTime('now',new \DateTimeZone('Asia/Jerusalem'));


        $userExistCheck = User::IsExist($userId);
        $passwordStrength = empty(\Services::PasswordStrengthCheck($userPassword));
        $passwordsMatch = ($userPassword === $userPasswordAgain) ? true : false;
        $emailsMatch = ($userEmail === $userEmailAgain) ? true : false;



        if(!$userExistCheck) {
            if($passwordStrength) {
                if ($passwordsMatch) {
                    if($emailsMatch) {

                        $arrayToCreateUserAddress = array(
                            "UserId" => $userId,
                            "PostalCode" => $userAddressPostalCode,
                            "CityName" => $userAddressCityName,
                            "Street" => $userAddressStreet,
                            "HouseNumber" => $userAddressHouseNumber,
                            "ApartmentNumber" => $userAddressApartmentNumber
                        );

                        try {
                            $newAddress = Address::Add($arrayToCreateUserAddress);
                        } catch (\Throwable $e) {
                            echo "תהליך ההרשמה לא הצליח, אנא נסה שוב מאוחר יותר";
                        }

                        $arrayToCreateUser = array(
                            "Id" => $userId,
                            "Email" => $userEmail,
                            "Password" => $passwordConverted,
                            "FirstName" => $userFirstName,
                            "LastName" => $userLastName,
                            "PhoneNumber" => $userPhoneNumber,
                            "PersonalNumber" => $userPersonalNumber,
                            "Birthday" => $userBirthday,
                            "Address" => $newAddress->GetId(),
                            "MilitaryType" => $userMilitaryType,
                            "Recruitment" => $userRecruitment,
                            "Profession" => $userProfession,
                            "Facebook" => $userFacebook,
                            "About" => $userAbout,
                            "RegisterDate" => $time->format("Y-m-d H:i:s"),
                            "Role" => 1
                        );
                        try {
                            $userObj = User::add($arrayToCreateUser);

                            //log
                            $logString = "נרשם חדש באתר בשם {$userObj->GetFullName()} תז {$userObj->GetId()}";
                            Rimon::NewLog($logString);

                        } catch (\Throwable $e) {
                            echo "תהליך ההרשמה לא הצליח, אנא נסה שוב מאוחר יותר";
                        }

                        $_SESSION["FlashText"] = "ההרשמה בוצעה בהצלחה! המשתמש שלך נשלח לבדיקה. לאחר סיום הבדיקה תקבל הודעה לדואר האלקטרוני (עלול להגיע לספאם) ותוכל להתחיל להנות מהתוכן היעודי לחברי העמותה בלבד";
                        User::GetById(Constant::CONFIRM_MASTER_ID)->SendEmail(EmailsConstant::Email_master, "נרשם חדש בעמותה!");
                        header("Location: flash.php");

                    } else
                        $errorMsg = "הרשמה לא בוצעה - שדות דואר אלקטרוני אינם תואמים.";
                } else
                    $errorMsg = "הרשמה לא בוצעה - שדות הסיסמאות אינם תואמים.";
            } else
                $errorMsg = "הרשמה לא בוצעה - סיסמה חלשה - סיסמה חייב להכיל 8 תווים, מתוכם אות גדולה, אות קטנה ומספר.";
        } else
            $errorMsg = "אירע שגיאה - הרשמה לא בוצעה.";
    } else
        $errorMsg = "נא לסמן 'אני לא רובוט'.";
}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row page-photo">
        <div class="col-sm-12 page-photo">
            <img src="media/pages/register.jpg">
        </div>  
    </div>
    
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1" data-aos="zoom-in-up">
            <h2 class="subtitles" style="text-align: center">הרשמה לעמותה</h2>
            <p><b>$errorMsg</b></p>
            <form method="post" role="form">
               
                    <h3>פרטים בסיסים</h3>
                    
                     <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-id">ת"ז</label>
                             <input type="text" class="form-control" id="new-user-form-id" name="new-user-form-id" placeholder="תעודת זהות" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-password">סיסמה</label>
                             <input type="password" class="form-control" id="new-user-form-password" name="new-user-form-password" placeholder="הסיסמה חייבת להכיל 8 תווים, אות גדולה ואות קטנה אחת לפחות." required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-password-again">סיסמה בשנית</label>
                             <input type="password" class="form-control" id="new-user-form-password-again" name="new-user-form-password-again" placeholder="חזרה על הסיסמה" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-first-name">שם פרטי</label>
                             <input type="text" class="form-control" id="new-user-form-first-name" name="new-user-form-first-name" placeholder="שם פרטי" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-last-name">שם משפחה</label>
                             <input type="text" class="form-control" id="new-user-form-last-name"  name="new-user-form-last-name" placeholder="שם משפחה" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-phone-number">מספר פלאפון</label>
                             <input type="text" class="form-control" id="new-user-form-phone-number"  name="new-user-form-phone-number" placeholder="מספר פלאפון" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-personal-number">מספר אישי</label>
                             <input type="text" class="form-control" id="new-user-form-personal-number"  name="new-user-form-personal-number" placeholder="מספר אישי" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">    
                        <div class="form-group">
                             <label for="new-user-form-email">אימייל</label>
                             <input type="email" class="form-control" id="new-user-form-email"  name="new-user-form-email" placeholder="דואר אלקטרוני" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">    
                        <div class="form-group">
                             <label for="new-user-form-email-again">אימייל בשנית</label>
                             <input type="email" class="form-control" id="new-user-form-email-again"  name="new-user-form-email-again" placeholder="דואר אלקטרוני" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-birthday">תאריך לידה</label>
                             <input style="text-align: right" type="text" class="form-control datepicker" id="new-user-form-birthday" name="new-user-form-birthday" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                          <div class="form-group">
                               <label for="new-user-form-profession">מקצוע (לא חובה)</label>
                               <input type="text" class="form-control" id="new-user-form-profession" name="new-user-form-profession" placeholder="מקצוע">
                          </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-facebook">פייסבוק (לא חובה)</label>
                             <input type="text" class="form-control" id="new-user-form-facebook" name="new-user-facebook" placeholder="פייסבוק">
                        </div>
                    </div>
                   
                 <div class="col-sm-12" style="padding-bottom: 40px">
                     <div class="form-group">
                          <label for="new-user-form-about">על עצמי (לא חובה)</label>
                          <input type="text" class="form-control" id="new-user-form-about" name="new-user-about" placeholder="על עצמי">
                     </div>
                 </div>
                    
                   <h3>כתובת</h3>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-postal-code">מיקוד</label>
                             <input type="text" class="form-control" id="new-user-form-postal-code" name="new-user-form-postal-code" placeholder="מיקוד" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-city-name">שם העיר</label>
                             <input type="text" class="form-control" id="new-user-form-city-name" name="new-user-form-city-name" placeholder="שם העיר/ישוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-street">רחוב</label>
                             <input type="text" class="form-control" id="new-user-form-street" name="new-user-form-street" placeholder="רחוב" required>
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="new-user-form-house-number">מספר בניין</label>
                             <input type="text" class="form-control" id="new-user-form-house-number" name="new-user-form-house-number" placeholder="מספר בניין">
                        </div>
                    </div>
                   
                   <div class="col-sm-12">
                        <div class="form-group" style="padding-bottom: 40px">
                             <label for="new-user-form-apartments-number">מספר דירה</label>
                             <input type="text" class="form-control" id="new-user-form-apartments-number" name="new-user-form-apartments-number" placeholder="מספר דירה">
                        </div>
                   </div>

                   
                   <h3>שירות צבאי</h3>
                   <div class="col-sm-12">
                    <div class="form-group">
                        <p><b>סוג שירות</b></p>
                        <select class="form-control" name="new-user-form-military-type">
                            <option value="1">לוחם</option>
                            <option value="2">תומך לחימה</option>
                            <option value="3">קצין</option>
                            <option value="4">אחר</option>
                        </select>
                       </div>
                   </div>
                   
                    <div class="col-sm-12">
                          <div class="form-group">
                               <label for="new-user-form-recruitment">תאריך גיוס</label>
                               <input type="text" style="text-align: right" class="form-control datepicker" id="new-user-form-recruitment" name="new-user-form-recruitment" placeholder="תאריך גיוס" required>
                          </div>
                    </div>
                        
                    <p><a href="terms-and-conditions.php" target="_blank">תנאי רישום ומדניות העמותה.</a></p>
                        
                   <div class="col-sm-12">
                        <div class="form-check">
                            <input type="checkbox" name="new-user-form-terms" id="new-user-form-terms" style="cursor: pointer" required>
                            <label for="new-user-form-terms" style="cursor: pointer">אני מאשר את התנאים ומדניות העמותה.</label>
                        </div>
                   </div>
                   
                   <div class="col-sm-12">
                        <div class="form-group">
                           <div class="g-recaptcha" data-sitekey="6LceIVAUAAAAABYbgsFsc1M3xaAqNF8dKyFK8uDE"></div>
                        </div>
                    </div>
                   
                   <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                        <input type="submit" value="הרשם" name="new-user-form-submit" class="btn btn-info btn-block">
                   </div>  
                    
                    <input type="hidden" name="new-user-form-token" value="{$token}">  
               </form> 

        </div>
        

    </div>
</div>

  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      yearRange: "-50:+0",
      changeYear: true,
      dateFormat: 'yy-mm-dd'
    });
  } );
  </script>
Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
