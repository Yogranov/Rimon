<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Jan-18
 * Time: 22:48
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "כנס רימון ה-3");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<script type='text/javascript' src='https://845.co.il/media/unitegallery/themes/carousel/ug-theme-carousel.js'></script>
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/rimon-meeting-3.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">כנס רימון ה-3</h2>   
                <p>אחרי חודשים של עבודה מאומצת מסביב לשעון, קיימנו בפעם השלישית בתולדות העמותה את כנס רימון השנתי!</p>
                <p>את הערב התחלנו במתחם מינגלינג ונטוורקינג, שבו אירחנו שלל דוכנים בנושאים של קריירה, אקדמיה, והטבות, שמהם יכלו ליהנות חברי העמותה. קידום, מסע ישראלי, ישראכרט, Milgapo, Saucony, הסוכנות היהודית, Reguard , ועוד שלל ארגונים שהעמותה מקיימת איתם שיתופי פעולה.</p>
                <p>לאחר מכן התכנסנו לשמוע מפי צוות ההנהלה של העמותה – היו”ר יונתן שילר, והמנכ”ל דוד חורש, מה העמותה עשתה בשנתיים האחרונות ומה תכניותיה לעתיד.</p>
                <p>בחלקו האחרון של הערב זכו הבוגרים לשמוע הרצאה מרתקת על הצבת יעדים והתמודדות עם אתגרים מפי דודו יפרח, אחד מחמשת המטפסים הישראלים שהגיעו לפסגת הר האוורסט.</p>
                <p>לסיכום, היה ערב איכותי מלא בתוכן, ערכים, ואנשים טובים. בדיוק בשביל הדברים האלה אנחנו פה, פועלים למען חברי העמותה, ותומכים בהם בכל דרך שבה ילכו. נתראה שנה הבאה!</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/rimon-meeting-3.jpg">
            </div>
        </div>
    </div>
    
        <div class="row">
            <div class="col-sm-12">    
                <div id="gallery" style="display:none;">
                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(1).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(1).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(2).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(2).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(3).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(3).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(4).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(4).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(5).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(5).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(6).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(6).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(7).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(7).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(8).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(8).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(9).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(9).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(10).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(10).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(11).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(11).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(12).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(12).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(13).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(13).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(14).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(14).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(15).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(15).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(16).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(16).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(17).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(17).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(18).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(18).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(19).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(19).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(20).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(20).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(21).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(21).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(22).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(22).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(23).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(23).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(24).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(24).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(25).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(25).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(26).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(26).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(27).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(27).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(28).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(28).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(29).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(29).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(30).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(30).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(31).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(31).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(32).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(32).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(33).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(33).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(34).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(34).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(35).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(35).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(36).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(36).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(37).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(37).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(38).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(38).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(39).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(39).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(40).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(40).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(41).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(41).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(42).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(42).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(43).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(43).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(44).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(44).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(45).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(45).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(46).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(46).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(47).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(47).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(48).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(48).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(49).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(49).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(50).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(50).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(51).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(51).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(52).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(52).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(53).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(53).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(54).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(54).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(55).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(55).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(56).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(56).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(57).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(57).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(58).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(58).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(59).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(59).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(60).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(60).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(61).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(61).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(62).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(62).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(63).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(63).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(64).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(64).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(65).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(65).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(66).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(66).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(67).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(67).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(68).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(68).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(69).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(69).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(70).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(70).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(71).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(71).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(72).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(72).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(73).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(73).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(74).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(74).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(75).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(75).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(76).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(76).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(77).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(77).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(78).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(78).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(79).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(79).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(80).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(80).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(81).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(81).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(82).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(82).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(83).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(83).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(84).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(84).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(85).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(85).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(86).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(86).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(87).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(87).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(88).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(88).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(89).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(89).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-3/thumbnail/rimon-meeting-3%20(90).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-3/big/rimon-meeting-3%20(90).jpg"
                         style="display:none">

                
                
                </div>
	
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery("#gallery").unitegallery();});
                </script>
            
            </div>
        </div>
    
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
