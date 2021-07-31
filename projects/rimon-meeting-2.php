<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 22:47
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "כנס רימון ה-2");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<script type='text/javascript' src='https://845.co.il/media/unitegallery/themes/carousel/ug-theme-carousel.js'></script>
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/rimon-meeting-2.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">כנס עמותת בוגרי רימון השני</h2>   
                <p>ב 30/6 קיימנו את כנס המשוחררים ה-2  של העמותה.</p>
                <p>אחת ממטרות העמותה היא הקמת מעטפת תומכת אשר תלווה את משוחררי היחידה בדרכם באזרחות, ותיתן להם את הכלים להמשיך לתרום מעצמם למען הכלל. לכן העמותה ארגנה ערב מיוחד במינו, ערב שמטרתו היא להקנות למשוחררים כלים וידע שיסייעו להם בהמשך דרכם.</p>
                <p>למי היה הערב מיועד?
                    <br>
                    לכולם! לוחמים, קצינים, תומכ”לים, מתנדבים, נגדים, בנים, בנות, כולם!</p>
                <p>לכנס הגיעו כ-60 משוחררים / משתחררים של היחידה.</p>
                <p> אז מה היה לנו? <br>
                    דוכנים מכל הסוגים, בנושאים של תעסוקה, השכלה, הטיול הגדול, ועוד.
                    <ul>
                        <li>שב”כ </li>
                        <li>“דיבייט” – תקשורת בינאישית וניהול  </li>
                        <li>HIGH Q</li>
                        <li>מסע ישראלי</li>
                        <li>“אדמה” – מרכז הדרכה וציוד טיולים </li>
                        <li>ש.ב. שמירה וביטחון  </li>
                        <li>Cosmo Italia</li>
                        <li“בר השגה” – חברת השמה לצעירים></li>
                        <li>ישראכרט</li>
                    </ul>
                
                </p>
                <p>לאחר הדוכנים, פתחנו את הערב עם משפחתו של יהשיר ארגוב ז”ל.<br>
                    יהשיר ארגוב היה בוגר מחזור א’ – לוחם ומפקד. לאחר השחרור מצה”ל טס לארה”ב, שם במהלך בילוי עם חברים השתמש בסם LSD. הסם השפיע על יהשיר בצורה קשה מאוד, יהשיר נכנס לדיכאון ולאחר שחזר לארץ שם קץ לחייו.<br>
                    נורית ארגוב, אמו של יהשיר, סיפרה לנו על מה שקרה לבנה והדגישה בפני המשתתפים את החשיבות בטיול בטוח. כן לצאת לעולם ולחוות חוויות, אך לדעת להבדיל בין חוויה לבין סכנה.
                </p>
                <p>לאחר מכן נציגי HIGH Q הרצו למשתתפים על עולם האקדמיה בישראל. מה צריך לעשות כדי ללמוד במכון להשכלה גבוהה, איך בודקים איזה ציון חסר כדי להתקבל לתואר המבוקש למי יש הקלות למוסדות השונים ועוד.</p>
                <p>אחריהם עלו צוות ההנהלה של העמותה, יונתן שילר ודוד חורש, וסיפרו למשתתפים על השנה האחרונה של העמותה. מה היה, מה יהיה, מה המטרה והכי חשוב – איך אפשר להתנדב בעמותה.</p>
                <p>לסיום עלה רן סיבוני “פורצים גבולות להצלחה”, והרצה על הצבת יעדים והגשמת שאיפות. <br>
                    רן סיפר על תחרות איש הברזל שעשה, והשתמש בו כמשל לחיי היום יום – “הצלחה היא לא חלום – היא אפשרות”.
                </p>
                <p>כנסי המשוחררים הם אחד מעמודי התווך של העמותה, אין תחליף לאיכות הכלים אותם מקבלים בכנס, ולכמות הדלתות שנפתחות במהלכו.</p>
                
                <p>
                    תודות:<br>
                        תודה מיוחדת לגיל ימין – ראש צוות פרויקטים, שלקח אחריות על הפקת הכנס. <br>
                        תודה לחברת “ישראכרט” שאירחו אותנו, ונתנו לנו את הפלטפורמה שהיינו צריכים כדי ליצור אירוע מיוחד שכזה. <br>
                        תודה אחרונה לכל מי שלקח חלק בהפקת האירוע.
                </p>
                
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/rimon-meeting-2.jpg">
            </div>
        </div>
    </div>
    
        <div class="row">
            <div class="col-sm-12">    
                <div id="gallery" style="display:none;">
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(1).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(1).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(2).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(2).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(3).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(3).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(4).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(4).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(5).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(5).jpg"
                         style="display:none">
 
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(6).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(6).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(7).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(7).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(8).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(8).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(9).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(9).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(10).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(10).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(11).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(11).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(12).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(12).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(13).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(13).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(14).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(14).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(15).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(15).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(16).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(16).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(17).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(17).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(18).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(18).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(19).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(19).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(20).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(20).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(21).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(21).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(22).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(22).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(23).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(23).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(24).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(24).jpg"
                         style="display:none">

                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(25).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(25).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/rimon-meeting-2/thumbnail/rimon-meeting-2%20(26).jpg"
                         data-image="../media/gallerys/projects/rimon-meeting-2/big/rimon-meeting-2%20(26).jpg"
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
