<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 22:41
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "קמפיין יהודה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/yehoda-campaign.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">קמפיין למען יהודה הישראלי</h2>   
                <h3 style="color: #800000; font-weight: bold">“היום זה יהודה, מחר זה אנחנו” 11/9</h3>
                <p>לא הגיוני שלוחם יוצא למלחמה, משאיר בבית אישה בהריון פלוס ילדה, נפצע אנושות, עובר תהליך שיקום ארוך ומייגע שבסופו המדינה מסרבת להחזיר אותו לביתו.</p>
                <p>בעיות ביורוקרטיות כאלה ואחרות לא מעניינות אותנו!</p>
                <p>לוחם שחוזר ממלחמה לא כמו שהלך לא צריך לרדוף אחרי המדינה, המדינה צריכה לרדוף אחריו. יהודה הישראלי, נחשון ליאור, עידו גל רזון וכל שאר הלוחמים שיצאו להגן על המדינה – לא אמורים להרגיש כמו בטיסטים שמנסים לעקוץ אימון. כל לוחם מכיר את התחושה הנוראית הזאת שאתה על האלונקה וכולם סוחבים אותך, התחושה הזאת שפקידי הבירוקרטיה רק מעצימים.</p>
                <p>המאבק הזה הוא למען כל אלה שנכנסו לאלונקה שהיה צריך, ולמען כל אלה שממשיכים להיכנס תחתיה לא משנה כמה היא כבדה. המערכת צריכה להשתנות, הלוחמים צריכים לקבל את מה שמגיע להם – כי מוסרית זה הדבר.</p>
                <p>כי היום זה יהודה, מחר זה אנחנו!</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <iframe style="width: 100%; height: 350px; border-radius: 10px; margin-top: 20px" src="https://www.youtube.com/embed/1jJ-RUZAWBY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
