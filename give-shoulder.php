<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 14-Jan-18
 * Time: 22:51
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "תנו כתף");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row">
        <div class="col-sm-12 page-photo" >
            <img src="media/pages/march16.jpg">
        </div>  
    </div>
    
    <div class="row">
         <div class="col-sm-7 pull-right" data-aos="zoom-in">
            <h2 class="subtitles">תנו כתף</h2>
            <h3>אנחנו צריכים עזרה!</h3>
            <p>יש לנו כל כך הרבה חלומות ושאיפות, וחזון העמותה הוא אינסופי, אבל אנחנו לא יכולים לבד. אנחנו צריכים אתכם, כן אותך הלוחם הטרי שרק רוצה לגלות עולם, כן אותך הסטודנטית שאין לה זמן לנשום, רק אתכם אנחנו יכולים להמשיך את המומנטום החזק שיצרנו.</p>
            <h3>אתם יודעים מי מפעיל את העמותה כיום?</h3>
            <p>אנחנו- הסטודנטים שאין להם זמן לנשום והמשוחררים הטריים שעדיין מחפשים את עצמם. אנחנו בשנות ה-20 לחיינו ואנחנו הקמנו עמותה, אנחנו מנהלים עמותה ואנחנו מפעילים עמותה.</p>
            <p>למה? כי אנחנו רוצים, התרומה הזאת נותנת לנו סיפוק שקשה לתאר אותו. העבודה הקשה שלנו יצרה וממשיכה ליצור ארגון חזק שממשיך לגדול בכל רגע. המסגרת הזאת נותנת לנו מקום להתפתח וללמוד מה שאנחנו רוצים. כפעילים בעמותה אנחנו מקבלים ניסיון מעשי בתחומים שאנחנו שואפים לעסוק בהם בעתיד. העמותה נוגעת בתחומים רבים כמו: במחשבים ואינטרנט, ניהול אירועים, שיווק, חוזים, ראיית חשבון, צילום ועריכה, ובאמת שאין לזה סוף.</p>
            
            <h4>את עושה קורס בהפקת אירועים? בואי תצברי ניסיון אצלנו!</h4>
            <h4>אתה לומד מדעי המחשב? בוא תעזור לנו להפעיל את אתר האינטרנט!</h4>
         
            <h3>אז במה אנחנו צריכים עזרה?</h3>
            <h4>המבנה הארגוני של העמותה בנוי על צוותי עבודה, כל צוות אחראי על תחום אחר.</h4>
        </div>
        <div class="col-sm-5 random-image" style="margin-top: 40px" data-aos="flip-left">
            <img src="media/random/give-shoulder.jpg">
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-7"  style="margin-top: 25px;" data-aos="fade-up"> 
            <h3><b>צוות טכנולוגי</b></h3>
                <h4>הצוות אחראי על הדברים הבאים:</h4>
            <ul>
                <li>ניהול אתר האינטרנט הרשמי של העמותה.</li>
                <li>ניהול קבוצת הפייסבוק של העמותה.</li>
                <li>ניהול רשימת התפוצה ואנשי הקשר של העמותה.</li>
                <li>עיצוב גרפי לפי צרכי העמותה.</li>
            </ul>
        </div>
        <div class="col-sm-5 random-image" data-aos="zoom-in"> 
            <img src="media/teams/technology.jpg">  
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-7 pull-right" style="margin-top: 20px;" data-aos="fade-up"> 
            <h3><b>צוות פרוייקטים</b></h3>
            <h4>לצוות הטכנולוגי דרושים אנשים עם ידע במחשבים, תכנות, עיצוב גרפי, אם זה מדבר אליכם, מקומכם בצוות הזה!</h4>
            <p>צוות פרויקטים אחראי על הקמה, יצירה ופיתוח של אירועים ייחודיים של העמותה.<br>
                יצירת ימי כיף וגיבוש של חברי העמותה, אירועים מכל הסוגים, הופעות, טיולים הרצאות לחברי העמותה, השתתפות במרוצים וכל אירוע שאתם רוצים להפיק לטובת חברי העמותה.<br>
                צוות פרויקטים מיועד לאנשים יצירתיים, יזמים, אנשים שאוהבים להפיק וליצור דברים חדשים. אם מה שכתוב כאן מדבר אליכם, מקומכם בצוות זה!</p>
        </div>
        <div class="col-sm-5 random-image" data-aos="zoom-in"> 
            <img src="media/teams/projects.jpg">  
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-7"  style="margin-top: 15px;" data-aos="fade-up"> 
           <h3><b>צוות אזרחות</b></h3>
            <p>צוות האזרחות מרכז את כל המידע הקיים בידי העמותה על תחומי: השכלה, תעסוקה, הטיול הגדול וכול׳.<br>
                הצוות אחראי על פיתוח קשרים עם מוסדות השכלה, מציאת מקומות עבודה המתאימים לבוגרי היחידה (אבטחה, הדרכה, ניהול, וכול’) והכוונה בנושא “הטיול הגדול״.<br>
                צוות זה אחראי על כנסי המשתחררים, על התוכן שלהם, על הלו״ז.<br>
                לצוות יש חשיבות עליונה למשתחררים שנוחתים באזרחות וצריכים חיבור יציב לקרקע. הליווי הזה שהעמותה תיתן, תכין למשתחררים נחיתה רכה באזרחות ויעזור להם להגשים את שאיפותיהם.<br>
                אתם מרגישים שיש לכם מה לתרום לצוות זה, מקומכם כאן!</p>
        </div>
        <div class="col-sm-5 random-image" data-aos="zoom-in"> 
            <img src="media/teams/civ.jpg">  
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-7 pull-right" style="margin-top: 20px;" data-aos="fade-up"> 
            <h3><b>צוות כספים</b></h3>
            <p>צוות כספים אחראי על העורק הראשי של העמותה – המשאבים, ועליו לייצר תכנית עבודה מסודרת לגיוס תרומות. <br>
                מתאים לאנשים דוברי מספר שפות ברמת שפת אם, עם כושר התבטאות ברמה מצוינת. <br>
                בצוות זה החומר האנושי חייב להיות ברמה הגבוהה ביותר!</p>
        </div>
        <div class="col-sm-5 random-image" data-aos="zoom-in"> 
            <img src="media/teams/money.jpg">  
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-7" style="margin-top: 25px;" data-aos="fade-up"> 
            <h3><b>צוות פרט וסיוע</b></h3>
            <p>הצוות אחראי על עזרה ותמיכה במשוחררים וחיילים כאחד. עולים חדשים, מעוטי יכולת ופצועי היחידה. <br>
                הצוות ידע לתת מענה למחסור של פריטים בסיסיים הרלוונטיים לכל בית, לדוגמא: מיטה, מקרר, מכונת כביסה וכו׳.<br>
                קיום קשר רציף עם מחלקת הת”ש של היחידה והתעדכנות בבעיות הקיימות. <br>
                יצירת קשרים עם העמותות הקיימות המתעסקות בתחום זה. לדוגמא: “עמותת בניה”. <br>
                אם תחום זה מדבר אליכם, מקומכם איתנו!</p>
        </div>
        <div class="col-sm-5 random-image" data-aos="zoom-in"> 
            <img src="media/teams/support.jpg">  
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-7 pull-right" style="margin-top: 20px;" data-aos="fade-up"> 
            <h3><b>צוות האח הגדול</b></h3>
            <p>צוות האח הגדול אחראי על הקשר עם המשרתים ביחידה.</p>
            <ul>
                <li>ליווי צוותים במסעות סוף מסלול, עלייה ליחידה וכול’.</li>
                <li>ארגון מתנות סוף מסלול ומתנות שחרור.</li>
                <li>ארגון אירועי מורל לרווחת החיילים.</li>
            </ul>
            <p>צוות “האח הגדול” מחפש אנשים שהאלונקה חסרה להם באזרחות, אם זה אתם אז תצטרפו אלינו!</p>
        </div>
        <div class="col-sm-5 random-image" data-aos="zoom-in"> 
            <img src="media/teams/bigbrother.jpg">  
        </div>
    </div>
    
    <div class="row">
         <div class="col-sm-7" style="margin-top: 15px;" data-aos="fade-up"> 
            <h3><b>צוות GROUP</b></h3>
            <p>צוות GROUP הוא הצוות שדואג ליצור הטבות לחברי העמותה.
                המטרות של צוות GROUP הם:</p>
                <p>יצירת מאגר של בתי עסק המקושרים לחברי העמותה, אשר ייתנו הנחות לחברים בעמותה. לדוגמא: מנהל פאב ששירת ברימון ויכול לתת הנחות לחברי העמותה, (ככה כולנו מרוצים, לבעל הפאב מגיעים לקוחות ולנו יש הנחות)</p>
                <p>יצירת קשרים ושיתופי פעולה עם חברות מובילות בשוק ועסקים חיצוניים, אשר ייתנו הנחות משמעותיות לחברי העמותה. לדוגמא: יצירת קשר עם חברת ציוד מחנאות, חברות ספורט, מסעדות ושלל הנחות שיהיו לחברי העמותה.</p>
                <p>צוות זה מיועד לעסקנים מבינינו. אם אתם כאלה תצטרפו אלינו!</p>
         
        </div>
        <div class="col-sm-5 random-image" data-aos="zoom-in"> 
            <img src="media/teams/group.jpg">  
        </div>
    </div>
    
    <br><br>
    <center>
    <h2>מצאתם תחום שאתם מתחברים אליו?</h2>
    <h2>מעולה! מוזמנים ליצור עמנו קשר – <a href="contact-us.php" target="_blank">כאן!</a></h2> 
    </center>
  
</div>
Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
