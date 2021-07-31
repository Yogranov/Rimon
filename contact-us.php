<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 10/01/2018
 * Time: 10:07
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "צור קשר");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$errorMsg = "";
if(isset($_POST["contact-us-submit"]) && empty($_POST["anti-spam"]) && Token::Check($_POST["contact-us-token"])){

    $secretKey = Constant::GOOGLE_RECAPTCHA_SECRET_KEY;
    $responseKey = $_POST["g-recaptcha-response"];
    $userIp = $_SERVER["REMOTE_ADDR"];
    $request_url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIp";
    $ch = curl_init($request_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($ch));

    if($response->success) {
        $subject = "צור קשר - פנייה חדשה מהאתר העמותה";
        $team = Team::GetById($_POST["contact-us-category"]);

        $message = EmailsConstant::Contact_us;
        \Services::setPlaceHolder($message, "Name", strip_tags($_POST["contact-us-name"]));
        \Services::setPlaceHolder($message, "Email", strip_tags($_POST["contact-us-email"]));
        \Services::setPlaceHolder($message, "PhoneNumber", strip_tags($_POST["contact-us-phone-number"]));
        \Services::setPlaceHolder($message, "IpAddress", $_SERVER['REMOTE_ADDR']);
        \Services::setPlaceHolder($message, "Subject", strip_tags($_POST["contact-us-subject"]));
        \Services::setPlaceHolder($message, "TextArea", strip_tags($_POST["contact-us-text-area"]));

        $teamMail = $team->GetEmail();
        $teamLeaderMail = $team->GetLeader()->GetEmail();
        $name = "עמותת רימון - צור קשר";

            $emailObject = Rimon::GetEmail($subject, $message);
            $emailObject->addAddress($teamMail, $name);
            $emailObject->addAddress($teamLeaderMail, $name);

            if (!$emailObject->send())
                echo "לצערנו המייל לא נשלח בעקבות תקלה טכנית, אנא נסה שוב מאוחר יותר.";

            //log
            $logString = "נשלח מייל 'צור קשר' לצוות <b>{$team->GetName()}</b>";
            Rimon::NewLog($logString);

            $_SESSION["FlashText"] = "המייל נשלח בהצלחה! פנייתך תתקבל אצל הגורם המתאים ואנו נשוב אליך בחזרה. תודה!";
            header("Location: flash.php");
    } else {
        $errorMsg = "נא לסמן 'אני לא רובוט'";
    }
}



$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/contact-us.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row contact-us" style="margin-bottom: 20px">
        <div class="col-sm-6 contact-us-pic" data-aos="flip-left">
            <img style="width: 80%; margin-right: 50px" src="media/random/contact-us.png">
        </div>

        <div class="col-sm-6 pull-right" data-aos="fade-up">
            <h2>צור קשר</h2>
            <center><p><b>$errorMsg</b></p></center>
            <p>רוצים להצטרף לעמותה? יש לכם איך לתרום ולעזור? או שסתם בא לכם לדבר איתנו. <br>
                אנחנו כאן בשבילכם, לכל שאלה או פנייה.
                <p><br><a href="http://m.me/Rimon.Grads"><img src="media/random/facebook.png"> התחל שיחה בפייסבוק</a></p><br>
                <p>לחלופין, ניתן להשאיר פרטים כאן ונחזור אלכם בהקדם אל הדוא”ל.</p>
                <form method="post" role="form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label for="contact-us-name">שם</label>
                            <input type="text" class="form-control" id="contact-us-name" name="contact-us-name" placeholder="שם" required>
                            </div>                                
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="contact-us-email">דואר אלקטרוני</label>
                                <input type="email" class="form-control" id="contact-us-email" name="contact-us-email" placeholder="דואר אלקטרוני" required>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label for="contact-us-phone-number">מספר פלאפון</label>
                              <input type="text" class="form-control" id="contact-us-phone-number" name="contact-us-phone-number" placeholder="מספר פלאפון" required>
                            </div>                                
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label>קטגורית פנייה:</label><br>
                                <select class="form-control" name="contact-us-category">
                                    <option value="7">הנהלת העמותה</option>
                                    <option value="2">שיתוף פעולה עסקי</option>
                                    <option value="5">בקשה לעזרה ותמיכה</option>
                                    <option value="1">תמיכה טכנית</option>
                                    <option value="7">נושא אחר</option>
                                </select>
                            </div>                                
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label for="contact-us-subject">נושא</label>
                              <input type="text" class="form-control" id="contact-us-subject" name="contact-us-subject" placeholder="נושא הפנייה" required>
                            </div>                                
                        </div>
                        
                       <div class="col-sm-12">
                            <div class="form-group">
                                <label for="contact-us-text">תוכן הפנייה</label>
                                <textarea rows="4" cols="50" class="form-control" id="contact-us-text" name="contact-us-text-area" placeholder="תוכן הפניה"></textarea>
                            </div>
                       </div>
                       
                        <div class="col-sm-12">
                            <div class="form-group">
                                   <!-- Google reCAPTCHA -->
                                <div class="g-recaptcha" data-sitekey="6LceIVAUAAAAABYbgsFsc1M3xaAqNF8dKyFK8uDE"></div>
                           </div>
                        </div>
                        
                    <input style="display: none" type="text" name="anti-spam">
                    <input type="hidden" name="contact-us-token" value="{$token}">
                    <input type="submit" value="שלח פנייה" name="contact-us-submit" class="btn btn-info btn-block">
                    
                    
                </form> 
           </div>
        </div>
    </div>
    
</div>
Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
