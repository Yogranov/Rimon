<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Jan-18
 * Time: 10:27
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "צוותי העמותה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .=
    <<<Index
<div class="container content">
        <div class="row">
            <div class="col-sm-12 page-photo" style="padding: 0">
                <img src="media/pages/teams.jpg" style="margin: 0">
            </div>  
        </div>
    <div class="teams-page">
    
            <div class="row" style="background-color: rgba(245,197,166,0.23); text-align: center; padding: 30px 0">
                <div class="col-sm-10 col-sm-offset-1" data-aos="fade-up">
                    <h2>צוותי החזית:</h2>
                    <p>צוותים אלו מגיעים במגע ישיר עם כלל חברי העמותה. הם מלווים את החיילים והמשוחררים בצורה ישירה – הם אלו שיחכו ללוחמים אחרי מסע עם ארוחה מפנקת, יכווינו את המשוחררים הטריים בחיי האזרחות ויסייעו לכל אלה שצריכים קצת עזרה מעבר.</p>
                </div>    
            </div>
        
        <div class="row" style="background-color: rgba(198,245,235,0.23);">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h3>צוות אזרחות:</h3>
                <p>אז השתחררנו מהיחידה, שנים שבהם חונכנו למצוינות, למדנו למקסם את היכולות שלנו ועמדנו בכל משימה שהצבנו לעצמינו. אז איך אנחנו לוקחים את כל אלה, ומכניסים אותם לארגז כלים ה”אזרחי” שלנו?.</p>
                <p>לא פשוט להשתחרר מהמסגרת הצבאית האינטנסיבית לוואקום של האזרחות. פתאום לעמוד בזמן – זה להגיע לעבודה, בלת”מ זה חשבון חשמל ובוחן רמה זה משהו שקורה בסוף הסמסטר.</p>
                <p>אנחנו בצוות אזרחות אחראים לעזור לכם להשתלב בחיים החדשים שלכם בצורה הטובה ביותר. נספק לכם מידע ועזרה בתחומים של : תעסוקה, השכלה, הטיול הגדול ועוד. בנוסף לכך אנחנו נייצר כנסי משתחררים, סדנאות הכוונה, פרויקטים ייחודיים ועוד.</p>
                <p>לצוות הזה יש חשיבות עליונה למשתחררים שנוחתים באזרחות וצריכים חיבור יציב לקרקע. הליווי שהעמותה תיתן, תכין למשתחררים נחיתה רכה באזרחות ותעזור להם לא ללכת לאיבוד.</p>
            </div>  
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="media/teams/civ.jpg">
            </div>  
        </div>
        
        <div class="row" style="background-color: rgba(223,245,201,0.23);">
            <div class="col-sm-7" data-aos="zoom-in">
                <h3>צוות האח הגדול:</h3>
                <p>מסלול ההכשרה מלא בריצות, תיקים כבדים ואלונקות, והשירות המבצעי מלא בלילות לבנים, חוסר ודאות ומבצעים מסוכנים.</p>
                <p>אין שלב בשירות הצבאי ביחידת רימון שאינו מלא באתגרים והתמודדויות, ובדיוק לשם כך קיים צוות האח הגדול. מטרת הצוות היא לתמוך במשרתים ביחידה ולסייע להם בכל דרך שהוא יוכל. </p>
                <p>העזרה תתבטא בהצטרפות למסעות, הענקת מתנות סוף מסלול ויצירת פינוקים באימונים ובפעילות מבצעית, כל אלה ועוד הם הוקרת התודה שלנו על פועלם של המשרתים ביחידה.</p>
                <p>לנו כעמותה ברור שלדברים הקטנים הללו, יש השפעה ישירה על מורל כלל היחידה – מהחייל הפשוט עד לקצינים הבכירים. לכן אנו נעשה כל שביכולתנו לסייע ליחידה להתמודד עם האתגרים בפניה היא ניצבת. המשרתים ביחידה נותנים מעצמם את כל כולם על מנת להגן על מדינת ישראל, ואנחנו ניתן מעצמינו את כל כולנו כדי שהם יעשו זאת בצורה הטובה ביותר.</p>
            </div>  
            <div class="col-sm-5 pull-right" data-aos="zoom-in">
                <img src="media/teams/bigbrother.jpg">
            </div>  
        </div>
        
        <div class="row" style="background-color: rgba(245,220,220,0.23);">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h3>צוות פרט וסיוע:</h3>
                <p>תדמיינו את הסיטואציה הבאה – צוות לוחמים בשבוע שטח מתגלגל. כל אחד סוחב תיק, חלק מהתיקים גדולים וחלק גדולים מאוד. אבל בסוף כולם צריכים ללכת את אותה הדרך, ולעמוד באותה המשימה. </p>
                <p>ככה זה גם בחיים מחוץ לצבא, כולנו רוצים לעמוד בקצב החיים, כולנו רוצים להגשים את שאיפותינו. מטרת צוות פרט וסיוע היא לעזור לאלה שסוחבים את התיקים הכבדים ביותר. </p>
                <p>מעוטי היכולת, החיילים הבודדים והפצועים. בין אם הם השתחררו או עדין משרתים בצבא, אנחנו פה בשבילם. </p>
                <p>אם יש לכם דרך לסייע לאחיינו ממשפחת רימון, המצויים בסיטואציות שציינו, אתם מוזמנים ליצור קשר עם ראש צוות פרט וסיוע – ניר גילה.</p>
                <p>טלפון: 0508464618
                <br>מייל: nird80@gmail.com </p>
            </div>  
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="media/teams/support.jpg">
            </div>  
        </div>        
        
            <div class="row team-page-title" style="background-color: rgba(245,197,166,0.23); text-align: center; padding: 30px 0">
                <div class="col-sm-12 pull-right" data-aos="zoom-in">
                    <h2>צוותי העורף:</h2>
                    <p>צוותים אלה אחראים על כל מה שקורה מאחורי הקלעים בעמותה. פרוייקטים מיוחדים, אינטרנט ומדיה, שיתופי פעולה אקסלוסיביים ועוד הרבה.</p>
                </div>    
            </div>
        
        <div class="row" style="background-color: rgba(198,245,235,0.23);">
            <div class="col-sm-7" data-aos="zoom-in">
                <h3>צוות טכנולוגיה:</h3>
                <p>
                    <ul>
                        <li>ניהול אתר האינטרנט הרשמי של העמותה.</li>
                        <li>ניהול קבוצת הפייסבוק של העמותה.</li>
                        <li>ניהול רשימת התפוצה ואנשי הקשר של העמותה.</li>
                        <li>עיצוב גרפי לפי צרכי העמותה.</li>
                    </ul>
                </p>
                 <p>צוות הטכנולוגי מורכב מפעילים בעלי ידע רחב במדיה, תיכנות, עיצוב גרפי ועוד. </p>
                
            </div>  
            <div class="col-sm-5 pull-right" data-aos="zoom-in">
                <img src="media/teams/technology.jpg">
            </div>  
        </div>
        
        <div class="row" style="background-color: rgba(223,245,201,0.23);">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h3>צוות כספים:</h3>
                <p>צוות כספים אחראי על העורק הראשי של העמותה – המשאבים, ועליו לייצר תכנית עבודה מסודרת לגיוס תרומות. </p>
                <p>מתאים לאנשים דוברי מספר שפות ברמת שפת אם, עם כושר התבטאות ברמה מצוינת.</p>
                <p>בצוות זה החומר האנושי חייב להיות ברמה הגבוהה ביותר!</p>
            </div>  
            <div class="col-sm-5  pull-right" data-aos="zoom-in">
                <img src="media/teams/money.jpg">
            </div>  
        </div> 
        
        <div class="row" style="background-color: rgba(245,220,220,0.23);">
            <div class="col-sm-7" data-aos="zoom-in">
                <h3>צוות פרויקטים:</h3>
                <p>צוות פרויקטים אחראי על הקמה, יצירה ופיתוח של אירועים ייחודיים של העמותה.</p>
                <p>יצירת ימי כיף וגיבוש, הופעות, טיולים הרצאות, השתתפות במרוצים וכל אירוע שיתרום להוואי המשפחתי הקיים בין חברי העמותה.</p>
                <p>צוות פרויקטים מורכב מפעילים יצירתיים, יזמים, אנשים שאוהבים להפיק וליצור.</p>
            </div>  
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="media/teams/projects.jpg">
            </div>  
        </div>
        
        <div class="row" style="background-color: rgba(245,199,184,0.23);">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h3>צוות GROUP:</h3>
                <p>צוות גרופ- מטרת הצוות היא יצירת שיתופי פעולה עסקיים עם ארגונים, עסקים וחברות באזרחות המתבטאים בין היתר בהטבות לחברי העמותה, פתיחת צוהר לתרומות עתידיות ורישות העמותה בעולם העסקי באזרחות.</p>
                <p>
                    <ul>
                        <li>יצירת מאגר של בתי עסק המקושרים לחברי העמותה, אשר ייתנו הנחות לחברים בעמותה. לדוגמא: מנהל פאב ששירת ברימון ויכול לתת הנחות לחברי העמותה, (ככה כולנו מרוצים, לבעל הפאב מגיעים לקוחות ולנו יש הנחות).</li>
                        <li>יצירת קשרים ושיתופי פעולה עם חברות מובילות בשוק ועסקים חיצוניים, אשר ייתנו הנחות משמעותיות לחברי העמותה. לדוגמא: יצירת קשר עם חברת ציוד מחנאות, חברות ספורט, מסעדות ושלל הנחות שיהיו לחברי העמותה.…</li>
                    </ul>  
                </p>
                <p>צוות פרויקטים מורכב מפעילים יצירתיים, יזמים, אנשים שאוהבים להפיק וליצור.</p>
            </div>  
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="media/teams/group.jpg">
            </div>  
        </div>        
        
               
    </div>














</div>

Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
