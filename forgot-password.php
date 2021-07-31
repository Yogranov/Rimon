<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 28-Jan-18
 * Time: 10:53
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

$errorMsg = "";
if(isset($_POST["forgot-password-submit"]) && Token::Check($_POST["forgot-password-token"])){
    if(!empty($_POST["forgot-password-email"])) {
        $userEmail = $_POST["forgot-password-email"];
        $personalNumber = $_POST["forgot-password-personal-number"];

        $checkEmail = Rimon::GetDB()->where("Email", $userEmail)->where("PersonalNumber",$personalNumber)->getOne("users","Id");
        if(!empty($checkEmail)) {
            $userObj = User::GetById($checkEmail["Id"]);

            //log
            $logString = "סיסמת איפוס נשלחה למשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
            Rimon::NewLog($logString);

            $userObj->ResetPassword();
        } else {
            $errorMsg = "לא נמצא משתמש התואם את הפרטים";

        }

    } else {
        echo "נא למלא את השדה המבוקש";
    }
}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/rimon-meeting-3.jpg">
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
                           <label for="forgot-password-email">דואר אלקטרוני</label>
                           <input type="email" class="form-control" id="forgot-password-email" placeholder="דואר אלקטרוני" name="forgot-password-email" required>
                        </div>
                        <div class="form-group">
                           <label for="forgot-password-personal-number">מספר אישי</label>
                           <input type="text" class="form-control" id="forgot-password-personal-number" placeholder="מספר אישי" name="forgot-password-personal-number" required>
                        </div>   
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group">
                          <input type="submit" value="אפס סיסמה" name="forgot-password-submit" class="btn btn-info btn-block">
                        </div>    
                    </div>
                </div>
                <input type="hidden" name="forgot-password-token" value="{$token}">
            </form>
        </div>
    </div>
   

</div>
Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
