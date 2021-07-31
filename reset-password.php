<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 28-Jan-18
 * Time: 12:09
 */

namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "איפוס סיסמה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



if(!isset($_GET["reset"])) {
    \Services::RedirectHome();
} else {
   $userDetailsDecode =  base64_decode($_GET["reset"]);
   $userDetails = explode("_",$userDetailsDecode);
}

$dbUser = Rimon::GetDB()->where("Email",$userDetails[0])->where("RecoverPassword",md5($userDetails[1]))->getOne("users","Id");
if(empty($dbUser)) {
    \Services::RedirectHome();
} else {
    $userObj = User::GetById($dbUser["Id"]);
}
$errorMsg = "";
if(isset($_POST["forgot-password-new-password-submit"]) && Token::Check($_POST["forgot-password-new-password-token"])){
    if($_POST["forgot-password-new-password"] === $_POST["forgot-password-new-password-again"]){
        $userPassword = Rimon::GetDB()->escape($_POST["forgot-password-new-password"]);
        $passwordStrength = empty(\Services::PasswordStrengthCheck($userPassword));

        if($passwordStrength) {

            $passwordHasher = new PasswordHash(16, true);
            $passwordConverted = $passwordHasher->HashPassword($userPassword);


            $userObj->Update(array("Password" => $passwordConverted,"RecoverPassword" => null));

            //log
            $logString = "המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b> שינה את הסיסמה.";
            Rimon::NewLog($logString);

            //send email to webmaster about user changing password
            $subject = "המשתמש {$userObj->GetFullName()} החליף סיסמה";

            $message = EmailsConstant::userChangingEmail;
            \Services::setPlaceHolder($message,"userName",$userObj->GetFullName());
            \Services::setPlaceHolder($message,"userId",$userObj->GetId());


            $to = Constant::WEBMASTER_EMAIL;
            $name = Constant::EMAIL_MAIN_NAME;


            $emailObject = Rimon::GetEmail($subject, $message);
            $emailObject->addAddress($to, $name);

            $emailObject->send();


            $_SESSION["FlashText"] = "סיסמתך שונתה בהצלחה! אתה מוזמן לחזור ולהנות ביחד איתנו!";
            header("Location: flash.php");
        } else{
            $errorMsg = "הסיסמה חלשה מדי, שים לב! הסיסמה חייבת להכיל שמנה מספרים ולפחות אות גדולה, אות קטנה וספרה.";
            echo $errorMsg;
        }
    } else {
        $errorMsg = "הסיסמאות לא תואמות, אנא נסה שוב";
        echo $errorMsg;
    }
}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/unitrandom4.jpg">
        </div>  
    </div>

    <div class="row" style="padding: 40px 0">
        <div class="col-sm-8 col-sm-offset-2">
            <h2 class="subtitles" style="text-align: center">איפוס סיסמה</h2>
            <p>{$errorMsg}</p>
            <form method="post" role="form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                           <label for="forgot-password-new-password">סיסמה חדשה</label>
                           <input type="password" class="form-control" id="forgot-password-new-password" placeholder="כתוב סיסמה חדשה" name="forgot-password-new-password" required>
                        </div>
                        <div class="form-group">
                           <label for="forgot-password-new-password-again">בדיקת סיסמה</label>
                           <input type="password" class="form-control" id="forgot-password-new-password-again" placeholder="חזור על הסיסמה" name="forgot-password-new-password-again" required>
                        </div>   
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group">
                          <input type="submit" value="אפס סיסמה" name="forgot-password-new-password-submit" class="btn btn-info btn-block">
                        </div>    
                    </div>
                </div>
                <input type="hidden" name="forgot-password-new-password-token" value="{$token}">  
            </form>
        </div>
    </div>
   

</div>
Index;




$pageTemplate .= footerTemplate;
echo $pageTemplate;
