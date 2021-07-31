<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 30-Dec-17
 * Time: 22:00
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "דף הבית");
$pageTemplate .= bodyTemplate;

Login::Reconnect();

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$pageTemplate .= <<<Index
<div class="slider-container">
      <div class="slider-control left inactive"></div>
      <div class="slider-control right"></div>
      <ul class="slider-pagi"></ul>
      
      <div class="slider">
      
       <div class="slide slide-0 active">
          <div class="slide__bg"></div>
          <div class="slide__content">
            <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
              <path class="slide__overlay-path" d="M0,0 150,0 300,405 0,405" />
            </svg>
            <div class="slide__text">
              <h2 class="slide__text-heading"><a class="slider-title-link" href="https://845.co.il/projects/journey-alkabetz.php" target="_blank">סוף מסלול צוות אלקבץ</a></h2>
              <p class="slide__text-desc">חברי העמותה עולים צפונה למסע סוף המסלול של צוות אלקבץ, צוות הלוחמים החדש.</p>
              <a href="https://845.co.il/projects/journey-alkabetz.php"
              class="slide__text-link">קישור לכתבה</a>
            </div>
          </div>
        </div>
      
        <div class="slide slide-1">
          <div class="slide__bg"></div>
          <div class="slide__content">
            <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
              <path class="slide__overlay-path" d="M0,0 150,0 300,405 0,405" />
            </svg>
            <div class="slide__text">
              <h2 class="slide__text-heading"><a class="slider-title-link" href="https://845.co.il/projects/shoam-adopt.php" target="_blank">שוהם מאמצת את העמותה</a></h2>
              <p class="slide__text-desc">מהיום זה כבר רשמי, מועצת שוהם וראש המועצה מר גיל ליבנה, יחד עם האגודה למען החייל שוהם, החליטו לאמץ את עמותת בוגרי רימון!.</p>
              <a href="https://845.co.il/projects/shoam-adopt.php"
              class="slide__text-link">קישור לכתבה</a>
            </div>
          </div>
        </div>
        
        <div class="slide slide-2 ">
          <div class="slide__bg"></div>
          <div class="slide__content">
            <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
              <path class="slide__overlay-path" d="M0,0 150,0 400,405 0,405" />
            </svg>
            <div class="slide__text">
              <h2 class="slide__text-heading"><a class="slider-title-link" href="https://845.co.il/projects/weapon-license.php" target="_blank">מבצע בוגר חמוש</a></h2>
              <p class="slide__text-desc">אחרי כמעט שנה של שחייה בביורוקרטיה סבוכה ומורכבת, הוצאנו לפועל יום הנפקה מרוכז לרישיונות נשק פרטיים..</p>
              <a href="https://845.co.il/projects/weapon-license.php" 
              class="slide__text-link">קישור לכתבה</a>
            </div>
          </div>
        </div>
        
        <div class="slide slide-3">
          <div class="slide__bg"></div>
          <div class="slide__content">
            <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
              <path class="slide__overlay-path" d="M0,0 150,0 300,405 0,405" />
            </svg>
            <div class="slide__text">
              <h2 class="slide__text-heading"><a class="slider-title-link" href="https://845.co.il/projects/rimon-meeting-3.php" target="_blank">כנס רימון השלישי</a></h2>
              <p class="slide__text-desc">אחרי חודשים של עבודה מאומצת מסביב לשעון, קיימנו בפעם השלישית בתולדות העמותה את כנס רימון השנתי!</p>
              <a href="https://845.co.il/projects/rimon-meeting-3.php"
              class="slide__text-link">קישור לכתבה</a>
            </div>
          </div>
        </div>
        
        <div class="slide slide-4">
          <div class="slide__bg"></div>
          <div class="slide__content">
            <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
              <path class="slide__overlay-path" d="M0,0 150,0 300,405 0,405" />
            </svg>
            <div class="slide__text">
              <h2 class="slide__text-heading"><a class="slider-title-link" href="https://845.co.il/projects/rimon-race-1.php" target="_blank">מירוץ רימון ה-1</a></h2>
              <p class="slide__text-desc">בהשתתפות בוגרי היחידה לדורותיה והלוחמים המשרתים בה כיום.</p>
              <a href="https://845.co.il/projects/rimon-race-1.php"
              class="slide__text-link">קישור לכתבה</a>
            </div>
          </div>
        </div>
        
        
      </div>
    </div>
<div class="container content">
    <div class="row">    
        <div class="col-sm-7 pull-right" data-aos="flip-right" style="line-height: 30px">
            <h1>עמותת בוגרי רימון:</h1>
            <p>
        יחידת רימון הנה יחידה מובחרת בצה”ל אשר הוקמה בשנת 2010 ביוזמת האלוף יואב גלנט. היחידה הוקמה במטרה לתת מענה מבצעי ואיכותי לאיומי הפח”ע
        וההברחות במרחב הגזרה הדרומי – מעזה ועד אילת.
        </p>
        <p>
        כיום, יחידת רימון הינה חלק מחטיבת “עוז” (חטיבת הקומנדו של צה”ל), ומוכשרת לפעול בתאי שטח מורכבים בכלל גזרות הלחימה.
        אנו, בוגריה הראשונים של היחידה, הקמנו את “עמותת בוגרי רימון“.
        </p>
        <p>
        המטרה שעומדת מאחורי הקמת העמותה הנה סיוע ותמיכה בחיילי ובוגרי היחידה. העזרה שלנו מתבטאת בכל התחומים – מפריסה לחיילי המסלול ועד עזרה לחיילים הבודדים גם לאחר השחרור.
        </p>
        <p>
        באתר שלנו תוכלו למצוא מידע על פעילות העמותה, על הטבות לחבריה, דרכי הצטרפות ועוד..
        היכנסו <a href="https://845.co.il/projects.php" target="_blank">לדף הפרוייקטים</a> שלנו ותישארו מעודכנים בכל פעילויות העמותה!
        תהנו!
        </p>
        </div>
        <div class="col-sm-5 who-us"  data-aos="flip-left">
            <img src="media/random/uni01.jpg">
        </div>        
        <div class="coop-follow-us">
            <div class="col-xs-6 col-sm-2 who-us"  data-aos="flip-left" >
                <a href="https://www.facebook.com/Rimon.Grads/" target="_blank"><img src="media/icons/followus.jpg" style="margin-right: -25px"></a>
            </div>
            <div class="col-xs-6 col-sm-2 who-us pull-right"  data-aos="flip-left" >
                <a href="https://845.co.il/cooperation.php" target="_blank"><img src="media/icons/coopbus.jpg" style="margin-right: 25px"></a>
            </div>
        </div>
    </div>
    <div style="margin: 50px 0 10px 0">
    <div class="row icons-row"> 
        <div class="col-sm-4"  data-aos="fade-up">
            <center>
            <h3>מי אנחנו</h3>
            <a href="https://845.co.il/meet-us.php" target="_blank"><img class="animated bounceIn" src="media/icons/teamwork.png" style="width: 60%"></a>
            <br><br>
            <p>בואו להכיר את פעילי העמותה, האנשים שמניעים את העמותה קדימה.</p>
            </center>
        </div>
        <div class="col-sm-4" data-aos="flip-right">
          <center>
          <h3>הרשמה לעמותה</h3>       
          <a href="https://845.co.il/register.php" target="_blank"><img src="media/icons/id-card.png" style="width: 60%"></a>
          <br><br>
          <p>מהרו להירשם לעמותה עוד היום והחלו להנות מהטבות בלעדיות והצעות עבודה אקסקלוסיביות.</p>    
          </center>
        </div>
        <div class="col-sm-4" data-aos="zoom-in-up">
          <center>
          <h3>פרוייקטים</h3>  
          <a href="https://845.co.il/projects.php" target="_blank"><img src="media/icons/projection.png" style="width: 60%"></a>
          <br><br>
          <p>אנו גאים להציג לכם את הפרויקטים של העמותה, שם תוכלו לראות את הפעילות שלנו.</p>
          </center>
        </div>
    </div>
</div>




<div class="row who-us">
    <div class="col-sm-7" data-aos="zoom-in">
    <h3>מי אנחנו</h3>
        <p>בשנת 2015 הוקמה עמותת “בוגרי רימון” על ידינו, בוגריה הראשונים של היחידה. הקמנו את העמותה לאחר שהחלטנו לעשות מעשה, אשר יבטא את הערכים אותם רכשנו במהלך השירות הצבאי ביחידה. ערכי הרעות, המצוינות והדחף לתרום לכלל, הם אשר הביאו אותנו לקבוע את מטרות העמותה כדלהלן:</p>
        <ul>
            <li><p>העמותה תשמש כמעטפת תומכת אשר תלווה  את המשרתים ביחידה לאורך שירותם הצבאי, ותסייע להם לשרת שירות משמעותי.</p></li>
            <li><p>העמותה תשמש כמעטפת תומכת אשר תלווה את משוחררי היחידה בדרכם באזרחות, ותיתן להם את הכלים להמשיך לתרום מעצמם למען הכלל כפי שעשו בשירותם הצבאי.</p></li>
            <li><p>העמותה תעודד יוזמות אשר יחזקו את הקשר בין בוגרי היחידה לבין אלה שעדיין לא פשטו את המדים. יוזמות אשר יחזקו את תחושת האחווה המשפחתית בין כל אלה שעברו בחייהם במסגרת שנקראת יחידת “רימון”.</p></li>
        </ul>
        <p>לכבוד הוא לנו לאגד את המשפחה הזאת תחת קורת גג אחת, ולנצל לטובת הכלל את ההון האנושי הגלום בה. אנו מאמינים כי יש אופי מיוחד מאוד לכל אדם שהוא חלק ממשפחת רימון, וברצונינו לטפח תכונה זאת, כך שכל עם ישראל יוכלו להרוויח ממנה.
עלו והצליחו,

עמותת בוגרי רימון.</p>
    </div>
    <div class="col-sm-5" data-aos="zoom-in-left">
        <img src="media/random/activities.jpg">
    </div>
</div>
</div>
<span style="display: none">{hideScript}</span> 
<!--
{modalBox}
{modalBoxActive}
-->
Index;

////// Inbox New Message Alert//////
if(isset($_SESSION["UserId"])) {
    $DBConversations = Rimon::GetDB()->where("Users", "%" . $_SESSION["UserId"] . "%", 'like')->get("conversation", null, "Id");
    foreach ($DBConversations as $conversation) {
        $conObj = Conversation::GetById($conversation["Id"]);
        foreach ($conObj->GetMessages() as $message) {
            if ((int)$message->GetDatetime()->format("U") - (int)$conObj->GetUserLastView()["{$_SESSION["UserId"]}"]->format("U") > 0) {
                echo "<div class=\"alert alert-danger shake new-message-noti\"><a href='user/mail/inbox.php'> <strong>שים לב!</strong> יש לך הודעה חדשה בתיבת הדואר האישי.</a></div>";
                \Services::setPlaceHolder($pageTemplate, "hideScript", "<script>$(\".alert-danger\").delay(4000).fadeOut(500)</script>");
                break;
            }
        }
    }
}
/////////////////

/*
//temp!!
if(isset($_SESSION["UserId"])){
    $userObj = User::GetById($_SESSION["UserId"]);
        $pop = <<<POP

<div class="modal fade" id="modal-Race" role="dialog" xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">מירוץ רימון ה-II</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-7 pull-right">
                <p><h2>מירוץ רימון ה-II</h2>
                <b>שימו ♥ - המירוץ נדחה ל-18/05/18!</b>
                </p>
                <p style="font-size: 16px">
                מה הולך {$userObj->GetFirstName()}? <br>
                על מירוץ רימון השני כבר שמעת? <br>
                ת'כלס? זה אירוע של פעם בשנה שאי אפשר לפספס. <br>
                אז יאללה, אנחנו מחכים, כל הפרטים ממש פה למטה: <br>
                <a href="https://845.co.il/family/calendar/event.php?EventVerify=MV8xNTE5MDQ2OTA0" target="_blank">למעבר לחץ כאן בראבק</a>
                </p>
              </div>
              <div class="col-sm-5 pull-left">
                <img src="media/uploads/29597945_1735053453182970_9053240008195065597_n.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>
POP;
        $popActive = <<<POPACTIVE
<script>
setTimeout(function() {
  $("#modal-Race").modal()
}, 1000);

</script>
POPACTIVE;

\Services::setPlaceHolder($pageTemplate, "modalBox", $pop);
\Services::setPlaceHolder($pageTemplate, "modalBoxActive", $popActive);
} else {
    \Services::setPlaceHolder($pageTemplate, "modalBox", "");
    \Services::setPlaceHolder($pageTemplate, "modalBoxActive", "");
}
//temp
*/

$pageTemplate .= footerTemplate;
echo $pageTemplate;
