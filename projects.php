<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Jan-18
 * Time: 12:46
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "פרויקטים");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/projects.jpg">
        </div>  
    </div>
    <div class="the-unit-articles">

        <div class="row">
            <div class="col-sm-12" data-aos="zoom-in">
                <h2>הפרויקטים של העמותה:</h2>
            </div>  
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail18.jpg">
            </div>
            <div class="col-sm-10">
                <h3>מסע סוף מסלול - צוות אלקבץ 08/02/2017</h3>
                <p>חברי העמותה עולים צפונה למסע סוף המסלול של צוות אלקבץ, צוות הלוחמים החדש.<br>
                <a href="projects/journey-alkabetz.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail17.jpg">
            </div>
            <div class="col-sm-10">
                <h3>שוהם מאמצת את היחידה 13/12/2017</h3>
                <p>מהיום זה כבר רשמי, מועצת שוהם וראש המועצה מר גיל ליבנה, יחד עם האגודה למען החייל שוהם, החליטו לאמץ את עמותת בוגרי רימון!<br>
                <a href="projects/shoam-adopt.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail16.jpg">
            </div>
            <div class="col-sm-10">
                <h3>בוגרי היחידה מוציאים רישיון נשק 26/11/2017</h3>
                <p>אחרי כמעט שנה של שחייה בביורוקרטיה סבוכה ומורכבת, הוצאנו לפועל יום הנפקה מרוכז לרישיונות נשק פרטיים.<br>
                <a href="projects/weapon-license.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail03.jpg">
            </div>
            <div class="col-sm-10">
                <h3>כנס רימון השלישי 25.5.17</h3>
                <p>כמדי שנה, בוגרי היחידה התכנסו בערב אחד למפגש בין בוגרי היחידה. הבוגרים זכו בכנס זה לקבל שלל הטבות, משרות ייחודיות והרצאה מרתקת. <br>
                <a href="projects/rimon-meeting-3.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail04.jpg">
            </div>
            <div class="col-sm-10">
                <h3>מירוץ רימון ה-1  19/05/17</h3>
                <p>הסטוריה קטנה ליחידה- מירוץ רימון הראשון התקיים בשוהם. חיילי היחידה וכ150 מחברי העמותה השתתפו בהפנינג שמסמן תחילת מסורת!  <br>
                <a href="projects/rimon-race-1.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail05.jpg">
            </div>
            <div class="col-sm-10">
                <h3>חלוקת משלוחי מנות ללוחמים לקראת פורים 15/03/17</h3>
                <p>חברי העמותה נסעו לבקר את לוחמי העמותה לכבוד פורים לחלק משלוחי מנות.  <br>
                <a href="projects/mishloach-manot.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail06.jpg">
            </div>
            <div class="col-sm-10">
                <h3>ערב חיילים בודדים מכל הזמנים 25/12/16</h3>
                <p>לכבוד חג החנוכה החלטנו לקיים אירוע מיוחד במינו – ערב חיילים בודדים מכל הזמנים!  <br>
                <a href="projects/lone-soldier.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail07.jpg">
            </div>
            <div class="col-sm-10">
                <h3>סדנת משוחררים 16/12/16</h3>
                <p>בפעם הראשונה- סדנה מקצועית המיועדת למשוחררים ולעתידים להשתחרר מן היחידה.  <br>
                <a href="projects/nlp.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail08.jpg">
            </div>
            <div class="col-sm-10">
                <h3>מסע עליה למסלול 02/09/16</h3>
                <p>חברי העמותה עלו צפונה לפנות בוקר כדי להצטרף לצוות שסיים היום את החלק הבסיסי בהכשרתו, את פרק החי”ר. מהיום יתחילו את פרק ההכשרה של לוחם רימון.  <br>
                <a href="projects/journey-march-16.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail09.jpg">
            </div>
            <div class="col-sm-10">
                <h3>התנדבות בשיפוץ ביתו של יהודה הישראלי 09/16</h3>
                <p>אתמול הגיעה קבוצה גדולה של חברי העמותה לביתו של אחינו יהודה הישראלי, כדי לסייע בשיפוץ הבית בעופרה ובהתאמתו לצרכיו החדשים של יהודה.  <br>
                <a href="projects/renovation-yehoda-house.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail10.jpg">
            </div>
            <div class="col-sm-10">
                <h3>“היום זה יהודה, מחר זה אנחנו” 09/16</h3>
                <p>“בעיות ביורוקרטיות כאלה ואחרות לא מעניינות אותנו!”. חברי העמותה והיחידה לא מוותרים על אף אחד.  <br>
                <a href="projects/yehoda-campaign.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail11.jpg">
            </div>
            <div class="col-sm-10">
                <h3>צוות “האח הגדול” מבקר באימון צלפים 08/16</h3>
                <p>צוות “האח הגדול” השקים קום ויצא לבקר הבוקר את צלפי היחידה שביצעו אימון במרכז הארץ. פתחנו את הבוקר במד”ס 6 קל (לא בטוח שלאזרחים מביננו היה קל 😉 ), ומשם המשכנו לארוחת בוקר של לוחמים.  <br>
                <a href="projects/big-brother-sniper-train.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail12.jpg">
            </div>
            <div class="col-sm-10">
                <h3> כנס עמותת בוגרי רימון השני 30/06/16</h3>
                <p>ב 30/6 קיימנו את כנס המשוחררים השני  של העמותה. אחת ממטרות העמותה היא הקמת מעטפת תומכת אשר תלווה את משוחררי היחידה בדרכם באזרחות, ותיתן להם את הכלים להמשיך לתרום מעצמם למען הכלל.  <br>
                <a href="projects/rimon-meeting-2.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail13.jpg">
            </div>
            <div class="col-sm-10">
                <h3> סוף מסלול צוות אוג‘ 14 10/15</h3>
                <p>צוות “האח הגדול” של העמותה הגיע לטקס סוף מסלול של צוות הלוחמים של אוג’ 14, כדי לחלק חבילות שי לכבוד סוף מסלול.  <br>
                <a href="projects/od14-end-course.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail14.jpg">
            </div>
            <div class="col-sm-10">
                <h3> ביקור יהודה ישראלי 09/15</h3>
                <p>לקראת ראש השנה תשע”ה, ארגנו חברי העמותה ביקור אצל פצוע של היחידה – יהודה ישראלי.  <br>
                <a href="projects/visiting-yehoda.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/projects/thumbnail15.jpg">
            </div>
            <div class="col-sm-10">
                <h3>כנס עמותת בוגרי רימון הראשון 25/06/15</h3>
                <p>ב25 ביוני 2015 עמותת בוגרי רימון קיימה את הכנס הראשון שלה. הכנס התקיים במלון קראון פאזה בתל אביב ונכחו בכנס כ70 איש, משוחררים, סדירים וקצינים כאחד.  <br>
                <a href="projects/rimon-meeting-1.php">מעבר לכתבה...</a></p>
            </div> 
        </div>
    </div>
    
</div>

Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
