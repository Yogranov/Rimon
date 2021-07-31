<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 07-Jan-18
 * Time: 20:44
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "היחידה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/theunit.jpg">
        </div>  
    </div>
    
    <div class="row">
        <div class="col-sm-12" data-aos="zoom-in">
            <h2 style="color: #800000; font-weight: bold; margin: 2px 0">היחידה:</h2>
        </div>  
    </div>
    
    <div class="row the-unit">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <p>יחידת רימון היא יחידה מובחרת בצה”ל שפעלה במסגרת חטיבת גבעתי (אוגוסט 2010-דצמבר2015), ב-27 בדצמבר 2015 היחידה הוכפפה לחטיבת הקומנדו. היחידה פועלת בכל מרחב פיקוד הדרום ומתמחה בלוחמת מדבר.</p>
            <p>היחידה הוקמה באוגוסט 2010 בלחצו של אלוף פיקוד הדרום, יואב גלנט, אשר גרס כי לפיקוד הדרום נדרשת יחידה מיוחדת ללחימה ברצועת עזה מחד ובחדירות המחבלים מחצי האי סיני בעומק הנגב מאידך, תוך שימת דגש על לוחמה במדבר. הרמטכ”ל דאז, גבי אשכנזי, הביע הסתייגות מן הבחירה בשם “רימון” ליחידה אולם גלנט התעקש והשם נבחר‏.</p>
            <p>הקמת היחידה הוטלה על רב-סרן בני מאיר, איש יחידת החילוץ והפינוי בהיטס בעברו, ולשעבר מפקד פלחה”ן גבעתי‏. שלא כמו יחידות ייעודיות אחרות, יחידת רימון הוקמה באמצעות גיוס צוות סדיר שהתגייס ישירות ליחידה, ולא באמצעות העברת חיילים מיחידות מיוחדות אחרות. האיתור והגיוס ליחידה נעשה באמצעות הגיבוש של חטיבת גבעתי.</p>
            <p>היחידה נקראה על שם יחידת רימון, שפעלה בפיקוד הדרום משנת 1970 עד שנת 2005.</p>
            <p><a href="https://he.wikipedia.org/wiki/%D7%99%D7%97%D7%99%D7%93%D7%AA_%D7%A8%D7%99%D7%9E%D7%95%D7%9F_(2010)" target="_blank">להמשך קריאה בויקיפדיה.</a></p>
        </div>  
    </div>
    <div class="the-unit-articles">
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-12">
                <h2>כתבות על היחידה:</h2>
            </div>  
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail01.jpg">
            </div>
            <div class="col-sm-10">
                <h3>קומנדו בחולות: המאבק למנוע את הפיגוע הגדול הבא מתחולל במדבר  13.5.17</h3>
                <p>חומה בגובה ארבעה מטרים הולכת ונשלמת בדרום הר חברון. המבריחים נדחקים למרחב מדברי, אותו ניצלו גם המחבלים משרונה כנקודת חדירה לישראל. כעת מחכים להם שם לוחמי יחידת רימון, יחידת הקומנדו המדברית שאורבת לסוחרי הנשק והמחבלים.</p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail02.jpg">
            </div>
            <div class="col-sm-10">
                <h3>מהמדבר לשמיים: קצין ב”רימון – ונווט קרב 26.08.16</h3>
                <p>חלום ללא גבול, עם פז”ם של 4.5 שנים, י’ בן ה-26 וחצי התגייס מחדש לקורס טייס, הוא החניך המבוגר ביותר בין מסיימי הקורס שיקבלו היום את דרגות הקצונה.</p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail03.jpg">
            </div>
            <div class="col-sm-10">
                <h3>שרים לאחרון הפצועים מצוק איתן: “מחכים לך” 03.06.15</h3>
                <p>חבריו של יהודה ישראלי שנפצע קשה בקיץ שעבר, “לא מתייאשים ומחכים שיקום ויחזור לעצמו”. האזינו לשיר שכתבו במיוחד עבורו.</p>
            </div> 
        </div>
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail04.jpg">
            </div>
            <div class="col-sm-10">
                <h3>יום אימונים עם חיילי סיירת רימון: “לא מתרגשים מדאעש, הם כמו קופיקס” 28.09.16</h3>
                <p>הלחימה בתנאי אקלים מדבריים קשים, היכולת לשנות צורה בן רגע, המוטיבציה להגיע ליחידה צעירה והמלתחה הייחודית. סיירת רימון מציינת 5 שנים להקמתה.</p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail05.jpg">
            </div>
            <div class="col-sm-10">
                <h3>צפו: לוחמי יחידת “רימון” משתלטים על מבנה 12.05.15</h3>
                <p>היחידה המיוחדת רימון מקיימת אימונים משותפים עם לוחמי היחידה ללוחמה בטרור, על מנת לשמור על כשירות מקצועית גבוהה של חייליה: “עוזרים לנו להתמודד טוב יותר עם מצבי חירום והתפעול שלהם”.</p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail06.jpg">
            </div>
            <div class="col-sm-10">
                <h3>סגולה לגבורה: לוחמי יחידת רימון של גבעתי יקבלו ציון לשבח 12.05.15</h3>
                <p>את טבילת האש הראשונה שלהם עברו לוחמי היחידה המובחרת במבצע צוק איתן. היכולות שהפגינו היו מרשימות: חיסול של 50 מחבלים, איסוף מודיעין והשמדת מנהרות – ללא הרוגים לכוחותינו.</p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail07.jpg">
            </div>
            <div class="col-sm-10">
                <h3>שומרים על אילת מפני דאע”ש 20.02.15</h3>
                <p>מפקד יחידת ‘רימון’: “אנחנו נמצאים באילת כדי לשמש אגרוף מחץ מהיר, שיודע לתת מענה לאירוע ולסיים אותו מהר. אני מניח שבדאע”ש מבינים שיהיה להם הרבה יותר קשה מאשר לפני שלוש וחצי שנים”.</p>
            </div> 
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail08.jpg">
            </div>
            <div class="col-sm-10">
                <h3>תקרית הירי בגבול מצרים 11.02.15</h3>
                <p>שני המבריחים ניסו לחצות את הגבול מישראל לסיני באזור ניצנה. מהתחקיר הצבאי עולה כי החיילים פתחו באש לעבר השניים לאחר שחוליית מבריחים ירתה לעברם ממעבר לגבול.</p>
            </div> 
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail09.jpg">
            </div>
            <div class="col-sm-10">
                <h3>ערנות, תושיה ומזל: רימון מסכמת את הלחימה ברצועת עזה 14.08.14</h3>
                <p>עזה היא ההתמחות שלהם, הם מתאמנים כבר ארבע שנים לקראת מבצע קרקעי בעומק הרצועה ועכשיו במבצע צוק איתן זה קרה. הלוחמים מספרים – רגעי המתח בתוך הבתים והמסגדים, על המחבלים שהתחבאו להם בתוך ארונות ואלו שיצאו
                    מתוך פירים, על הפעולות הנועזות שלהם וגם על מה שהם קוראים לו מזל.</p>
            </div> 
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail10.jpg">
            </div>
            <div class="col-sm-10">
                <h3>משפחתו של החייל הפצוע יהודה הישראלי שומרת על תקווה 03.08.14</h3>
                <p>החייל יהודה הישראלי נפצע באורח קשה בקרבות שנערכו ברפיח ביום שישי האחרון. אשתו רבקה, הנמצאת בחודש התשיעי להריונה, לא עוזבת את בית החולים סורוקה ומצפה שיהודה יחלים ויהיה עמה בחדר הלידה. הימים הקשים שעברו על המשפחה בסוף השבוע, וגם – רגע אחד של אופטימיות.</p>
            </div> 
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail11.jpg">
            </div>
            <div class="col-sm-10">
                <h3>חיות המדבר: הצצה לאימון של יחידת רימון 06.03.14</h3>
                <p>כשלפני שלוש שנים הבינו שהמצב בגבול עם מצרים לא נעשה פשוט יותר, הביאו את מיטב הלוחמים והמפקדים מיחידות העלית של צה”ל והקימו את יחידת רימון, שעושה לארגוני הטרור בסיני בית ספר. לאחרונה סיימו בסיירת את שבוע הסדנה המדברית, ואנחנו קיבלנו הצצה לאימון שהופך את הלוחמים לחיות שטח ולחלק מהנוף המדברי.</p>
            </div> 
        </div>
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail12.jpg">
            </div>
            <div class="col-sm-10">
                <h3>“כמו זיקית”: הצצה לאימון החורף של לוחמי המדבר 01.02.14</h3>
                <p>היחידה המובחרת “רימון” הוקמה לפני 4 שנים כדי לתת מענה לאיום הג’יהאד העולמי בסיני. השבוע הצטרפנו לאימון הראשון של לוחמיה בכפור של רמת הגולן. “נשק יום הדין של גבעתי”.</p>
            </div> 
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail13.jpg">
            </div>
            <div class="col-sm-10">
                <h3>החייל הבודד שחיסל לבד 4 מחבלים 23.01.14</h3>
                <p>תפסו מחסה”, זעק המפקד לחייליו באחד מקרבות “צוק איתן” באזור רפיח. אבל סהר אלבז (20), חייל בודד מגבעתי, התעלם מהסכנה. הוא ניצב חשוף מול המחבלים המסתערים וחיסל אותם בזה אחר זה. “היה לי ברור שזה או אני או הם”. בשל אומץ ליבו יקבל את צל”ש הרמטכ”ל.</p>
            </div> 
        </div>
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail14.jpg">
            </div>
            <div class="col-sm-10">
                <h3>רס”ן ב’, שהקים מחדש את סיירת רימון, מסיים את תפקידו 19.08.12</h3>
                <p>רס”ן ב’ הקים את הסיירת מחדש, המהווה כיום חוד החנית של חטיבת גבעתי ופיקוד הדרום. רס”ן ב’: “בבוא היום נדע לעמוד איתן ולהגן על המולדת”.</p>
            </div> 
        </div>
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail15.jpg">
            </div>
            <div class="col-sm-10">
                <h3>צה”ל ירה על מבריחים בגבול, מסתננים נפצעו 28.05.12</h3>
                <p>המבריחים החמושים ניהלו קרב יריות עם חיילים מסיירת רימון ונמלטו בחזרה למצרים – בעוד שלושה מסתננים סינים פצועים עברו לישראל ופונו לבית החולים סורוקה. אחד מהם אושפז במצב בינוני. ישי: המאבק לא מתיר פגיעה פיזית במסתננים.</p>
            </div> 
        </div>
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail16.jpg">
            </div>
            <div class="col-sm-10">
                <h3>ערב ראש השנה, צה”ל פותח את סיירת רימון 28.09.11</h3>
                <p>שנה וחצי לאחר הקמתה, התקבל אתמול לסיירת רימון הצוות הראשון. המציאות בגבול המצרי כבר מאתגרת אותו.</p>
            </div> 
        </div>

        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail17.jpg">
            </div>
            <div class="col-sm-10">
                <h3>הצצה ראשונה אל “סיירת רימון” – כוח הקומנדו של הגבול הדרומי 23.08.11</h3>
                <p>כלקח ממבצע “עופרת יצוקה”, הקימה חטיבת גבעתי מחדש את סיירת “רימון”, כוח קומנדו המוכשר ללחימה בטרור במרחביו העצומים של פיקוד הדרום. צפו 
                    באימוני היחידה.</p>
            </div> 
        </div>
        
        <div class="row" data-aos="zoom-in"  style="border-top: 1px solid rgba(0, 0, 0, 0.3); padding-top: 20px">
            <div class="col-sm-12">
                <h2>צל"שים:</h2>
            </div>  
        </div>
    
        <div class="row" data-aos="zoom-in">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail18.png" style="width: 80%; border: none">
            </div>
            <div class="col-sm-10">
                <h3>צל”ש יחידתי, יחידת “רימון” – חטיבת “גבעתי”</h3>
                <p>צל”ש האלוף.</p>
            </div> 
        </div>
    
        <div class="row" data-aos="zoom-in" style="padding-bottom: 20px;">
            <div class="col-sm-2 pull-right">
                <img src="media/thumbnail/articles/thumbnail19.jpg" style="width: 80%">
            </div>
            <div class="col-sm-10">
                <h3>צל"ש לסמל סהר אלבז</h3>
                <p>צל”ש הרמטכ”ל.</p>
            </div> 
        </div>
        
    </div>
    
</div>


Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
