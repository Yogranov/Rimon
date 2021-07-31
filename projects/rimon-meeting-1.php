<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 23:06
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "כנס רימון ה-1");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/rimon-meeting-1.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">כנס עמותת בוגרי רימון הראשון</h2>   
                <p>ב25 ביוני 2015 עמותת בוגרי רימון קיימה את הכנס הראשון שלה. הכנס התקיים במלון קראון פאזה בתל אביב ונכחו בכנס כ70 איש, משוחררים, סדירים וקצינים כאחד.</p>
                <p>הכנס התחיל במתחם של דוכנים לטובת בוגרי היחידה. היו דוכנים מהתחומים הבאים: <br>
                     אבטחה, עבודה מועדפת בחקלאות, ייעוץ עסקי, הכנה ל”טיול הגדול”, HIGH Q להשכלה גבוהה, וארז יער – עו”ד המייצג תביעות לוחמים מול משרד הביטחון.
                </p>
                <p> לאחר מכן עלו לדבר:
                    <ul>
                       <li>נורית ארגוב, אמא של בוגר היחידה יהשיר ארגוב ז”ל. אמא של יהשיר סיפרה לנוכחים את סיפורו של יהשיר וביקשה מהם להיזהר במהלך הרפתקאותיהם מסביב לעולם.</li>
                       <li>בני מאיר, המפקד הראשון של היחידה.</li>
                       <li>דני פרל, מילואימניק של היחידה.</li>
                       <li>יונתן שילר ודוד חורש, צוות ההנהלה של העמותה, דיברו על חזון העמותה ועל תכנית העבודה שלה.</li>
                       <li>רם בירן, קצין לשעבר ביחידה סיפר על הלחימה בצוק איתן.</li> 
                   </ul>
                </p>
                <p>הכנס היה ראשון מסוגו ורבים מחברי העמותה סייעו בהפקתו. אין ספק שזאת הייתה רק שריקת הפתיחה, והעמותה תשאף להמשיך לקיים כנסים רבים מסוג זה.</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/rimon-meeting-1.jpg">
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
