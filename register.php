<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 14-Jan-18
 * Time: 22:13
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";


$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הרשמה לעמותה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);




$pageTemplate .= <<<Index
<div class="container content">

    <div class="row page-photo">
        <div class="col-sm-12 page-photo">
            <img src="media/pages/register.jpg">
        </div>  
    </div>
    
    <div class="row">
        <div class="col-sm-7 col-xs-12 pull-right" data-aos="zoom-in-up">
            <h2 class="subtitles">הרשמה לעמותה</h2>
            <h3>מי יכול להירשם לעמותה?</h3>
            <p>כל אחד/ת שעבר/ה במסגרת המדהימה הזאת שנקראת יחידת רימון. לוחמים, קצינים, נגדים, תומכ”לים, מתנדבים, מילואימניקים, כל מי ששירת ביחידה – כולם!</p>
            <h3>מה תפקידי בתור חבר/ה בעמותה?</h3>
            <p>דבר ראשון, להרגיש חלק ממשפחת רימון. אנחנו כעמותה מנסים לייצר המון פעילות בתחומים שונים. בין אם זה שיתופי פעולה עם היחידה או פרויקטים מיוחדים לאזרחים – אנחנו רוצים שתהייה שם, שתדע להנות מהטוב שאנחנו מנסים לייצר. </p>
            <p>אם תרצה לקחת את חברותך בעמותה לשלב הבא ולהפוך להיות פעיל בה,<br>תיכנס לדף <a href="give-shoulder.php">תנו כתף</a> ותראה היכן אתה מעוניין לתרום.</p>
            <br>
            <h3>מה מקבל חבר/ה בעמותה?</h3>
            <p>מלבד האפשרות להשתתף בפרויקטים השונים שלנו, יש לנו בעמותה מועדון הטבות לחברים בלבד.
               העמותה עושה כל שביכולתה כדי ליצור מגוון רחב של הטבות בתחומים של השכלה, צרכנות, ועוד.<br>
               כחבר/ה רשומ/ה בעמותה הנך זכאי/ת להנות ממועדון הטבות זה!</p>
            <p>אז למה לא? <br>
                אין סיבה, אז קדימה- <a href="register-form.php"><b>להרשמה לחצו כאן</b></a>!
            </p>
        </div>
        
        <div class="col-sm-5 col-xs-12 who-us" style="margin-top: 30px;" data-aos="flip-left">
            <img src="media/random/writing.jpg" style="width: 100%;">
        </div>  
        
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
