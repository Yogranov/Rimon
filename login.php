<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 19-Jan-18
 * Time: 15:44
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

//Init
$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "תרום לעמותה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

if(isset($_SESSION["UserId"]))
    \Services::RedirectHome();

$errorMsg = "";

if(isset($_POST['header-login-form-login'])) {

    $secretKey = Constant::GOOGLE_RECAPTCHA_SECRET_KEY;
    $responseKey = $_POST["g-recaptcha-response"];
    $userIp = $_SERVER["REMOTE_ADDR"];
    $request_url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIp";
    $ch = curl_init($request_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($ch));

    if($response->success) {

        $email = Rimon::GetDB()->escape(strip_tags($_POST['header-login-form-id']));
        $password = Rimon::GetDB()->escape(strip_tags($_POST['header-login-form-password']));
        @$remember = ($_POST['header-login-form-remember-me']) ? true : false;


        try {
            $newLogin = new Login($email, $password, $remember);
            if ($newLogin)
                header("Location: family/main.php");
            else
                session_destroy();

        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
        }
    } else {
        $errorMsg = "נא לסמן 'אני לא רובוט'";
    }
}



$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/donate.jpg">
        </div>  
    </div>

    <div class="row" style="padding: 40px 0">
        <h2 class="subtitles" style="text-align: center; letter-spacing: 4px">התחבר</h2>
        <div class="col-sm-6 col-sm-offset-3" style="font-size: 18px;">
       <p style="text-align: center"><b>$errorMsg</b></p>
                <form method="post" role="form">
                     <div class="col-sm-12">
                        <div class="form-group">
                             <label for="header-login-form-id">ת"ז</label>
                             <input type="text" class="form-control" id="header-login-form-id" name="header-login-form-id" placeholder="תעודת זהות" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-group">
                             <label for="header-login-form-password">סיסמה</label>
                             <input type="password" class="form-control" id="header-login-form-password" name="header-login-form-password" placeholder="סיסמה" required>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input type="checkbox" name="header-login-form-remember-me" id="header-login-form-remember-me" style="cursor: pointer">
                            <label for="header-login-form-remember-me" style="cursor: pointer">זכור אותי</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <center><div style="width: 10%" class="g-recaptcha" data-sitekey="6LceIVAUAAAAABYbgsFsc1M3xaAqNF8dKyFK8uDE"></div></center>
                        </div>
                    </div>
                    <div class="col-sm-12" style="padding-top: 20px">                   
                        <input type="submit" value="התחבר" name="header-login-form-login" class="btn btn-info btn-block">
                    </div>  
                    
                </form>
         
    </div>
    </div>
</div>

Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
