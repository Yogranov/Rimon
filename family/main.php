<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 20-Jan-18
 * Time: 19:16
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "משפחה");
$pageTemplate .= bodyTemplate;


$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

//check personalNumber And Recruitment
$userObj = User::GetById($_SESSION["UserId"]);

$personalNumber = Rimon::GetDB()->where("Id",$userObj->GetId())->getOne("users","PersonalNumber");
$recruitmentDate = Rimon::GetDB()->where("Id",$userObj->GetId())->getOne("users","Recruitment");


if($personalNumber["PersonalNumber"] <= 1 || $recruitmentDate["Recruitment"] == null)
    header("Location: completedetails.php");

$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/projects-race-1.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12" data-aos="zoom-in-up">
            <h2 class="subtitles">דף הבית של משפחת רימון</h2>
            <p>היי {$userObj->GetFirstName()}! מה המצב? &#9786; </p>
            <p>ברוכים הבאים לתא המשפחתי שלנו. כאן נוכל לחלוק מקום קטן המשותף לכולם.</p>
            <p>ממליצים לך לקפוץ לבקר ולהתעדכן בדברים החדשים שאנחנו יוצרים עבורך ועבור המשפחה.</p>
            <p>אז מה יש כאן? 
        </div>
    </div> 
      
    <div class="row family-icons"> 
        <div class="col-sm-4 pull-right"  data-aos="fade-up">
            <center>
            <h3>הטבות חמות -</h3>
            <a href="benefits.php"><img class="animated bounceIn" src="../media/random/benefits.png" ></a>
            <br><br>
            <p>אנו עומלים מדי יום בשביל להביא לכם את ההטבות הכי חמות ממה עד הבית, לכם נשאר רק להכנס ולהנות.</p>
            </center>
        </div>
        <div class="col-sm-4" data-aos="zoom-in-up">
          <center>
          <h3>לוח דרושים -</h3>  
          <a href="https://845.co.il/family/jobs/jobsboard.php"><img src="../media/random/jobs.png"></a>
          <br><br>
          <p>כאן תוכלו למצוא לשתף עבודות שוות שעוברות מפה לאוזן.</p>
          </center>
        </div>
        <div class="col-sm-4" data-aos="flip-right">
          <center>
          <h3>חותמת העמותה -</h3>       
          <a href="https://845.co.il/family/sign.php"><img src="../media/random/rimonsign.png" style="width: 50%"></a>
          <br><br>
          <p>חותמת העמותה - בהצגת חותמת זו בבתי העסק השונים תוכלו לקבל את שלל ההטבות, ללא שום כרטיס פיזי.</p>    
          </center>
        </div>
        <div class="col-sm-6" data-aos="flip-right">
          <center>
          <h3>לוח מודעות -</h3>       
          <a href="https://845.co.il/family/message-board/board.php"><img src="../media/random/messageboard.png" style="width: 40%"></a>
          <br><br>
          <p>כל החדשות, כל העדכונים - הכל מרוכז ומסודר כאן למענכם.</p>    
          </center>
        </div>
        <div class="col-sm-6" data-aos="flip-right">
          <center>
          <h3>לוח אירועים -</h3>       
          <a href="https://845.co.il/family/calendar/calendar.php"><img src="../media/random/calendar.png" style="width: 40%"></a>
          <br><br>
          <p>כל האירועים, כל הדברים החשובים - הכל כאן.</p>    
          </center>
        </div>
    </div>
</div>
<!--
{modalBox}
{modalBoxActive}
-->
Index;

/*
//temp!!
if(isset($_SESSION["UserId"])){
    $userObj = User::GetById($_SESSION["UserId"]);
    $pop = <<<POP

<div class="modal fade" id="modal-Race" role="dialog">
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
                <img src="../media/uploads/29597945_1735053453182970_9053240008195065597_n.jpg">
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
