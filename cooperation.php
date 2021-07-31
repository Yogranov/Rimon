<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 15-Jan-18
 * Time: 10:16
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "שתפי פעולה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row">
        <div class="col-sm-12 page-photo" >
            <img src="media/pages/business.jpg">
        </div>  
    </div>
    
<div class="row">
         <div class="col-sm-7 pull-right" data-aos="zoom-in">
            <h2 class="subtitles">שיתוף פעולה לעסקים</h2>
            <h3>יש לכם עסק? להורים שלכם יש עסק? מכירים מישהו שיש לו עסק?</h3>
            <p>אם כן, אז בואו תצרפו אותו למועדון ההטבות של עמותת בוגרי רימון, ותהפכו אותו לחלק מרשימת עסקים איכותיים הנמצאים בשיתוף פעולה עם העמותה.</p>
            <p>אחת המשימות שלקחנו על עצמינו כעמותה, היא לייצר מגוון רחב של הטבות ככל האפשר, לרווחת חברי העמותה. אנו מבינים שכארגון יש לנו כוח קנייה גדול מאוד, וברצוננו לממש פוטנציאל זה בצורה מקסימלית.</p>
            <h3>אז איך זה משתלם לבעל העסק?</h3>
            <p>נכון לחודש ינואר 2017, עמותת בוגרי רימון מונה מעל 500 חברים. בעל
                עסק שעובד איתנו בשיתוף פעולה, מייצר לעצמו במכה אחת, מעל 400 לקוחות קבועים, שיעדיפו אותו על פני המתחרים. בנוסף לכך חשוב לציין, העמותה נמצאת בתהליך צמיחה תמידי, ומספר החברים בה לעולם יהיה במגמת עלייה.</p>
            <h3>רוצים להתחיל שיתוף פעולה עם העמותה?</h3>
            <p>לחצו על “<a href="contact-us.php" target="_blank"><b>צור קשר</b></a> ” בחלקו העליון של העמוד, מלאו את פרטיכם ואנו מבטיחים לחזור אליכם בהקדם!</p>
        </div>
        <div class="col-sm-5 random-image" style="margin-top: 40px" data-aos="flip-left">
            <img src="media/random/handshake-icon.jpg">
        </div>
    </div>
    
            
            
            

    
    
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
