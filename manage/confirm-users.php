<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 01-Feb-18
 * Time: 10:28
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";
const PASSWORD = "RimonCon";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "אישור משתמשים");
$pageTemplate .= bodyTemplate;
$userMainObj = User::GetById($_SESSION["UserId"]);

$permissions = Rimon::GetPermissions(2);
    \Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
    \Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

    $dBRes = Rimon::GetDB()->where("Role",1)->get("users",null,"Id");


$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom6.jpg">
        </div>  
    </div>

    <div class="row" style="padding: 40px 0">
        <div class="col-sm-10 col-sm-offset-1">
           <h2 class="subtitles">אישור משתמשים</h2>
                {MainContent}
        </div>

</div>
Index;

$beforePassword = <<< BeforePassword
{error}
<p>אנא הכנס סיסמה על מנת לראות את התוכן הנדרש:</p>
<form method="post" role="form">
         <div class="col-sm-12">
            <div class="form-group">
                 <label for="confirm-users-form-password">סיסמה</label>
                 <input type="password" class="form-control" id="confirm-users-form-password" name="confirm-users-form-password" placeholder="הכנס סיסמה" required>
            </div>
        </div>
        
        
        <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
            <input type="submit" value="פתח נעילה" name="confirm-users-form-submit" class="btn btn-info btn-block">
        </div>  
        
    </form>
BeforePassword;


$correctPass = <<< Pass
       <p>בדף זה מוצגים האנשים שנרשמו וטרם אושרו כי בוודאות שירותו ביחידה. יש לעבור על הרשימה ולאמת מול הגורם המתאים לפני האישור.</p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        {SearchBigTable}
    </div>
</div>
Pass;

/////////Login the user to form///////////////
if(isset($_POST["confirm-users-form-submit"])) {
    if(isset($_POST["confirm-users-form-password"]) && $_POST["confirm-users-form-password"] == PASSWORD) {
        \Services::setPlaceHolder($pageTemplate, "MainContent", $correctPass);
        $_SESSION["Confirm_Users"] = "YES";

        //log
        $logString = "המשתמש <b>{$userMainObj->GetFullName()}</b> תז <b>{$userMainObj->GetId()}</b> נכנס לדף אישור משתמשים.";
        Rimon::NewLog($logString);

    }else {
        \Services::setPlaceHolder($beforePassword, "error", "<p>סיסמה לא נכונה</p>");
        \Services::setPlaceHolder($pageTemplate, "MainContent", $beforePassword);
    }
} else if(isset($_SESSION["Confirm_Users"]))
    \Services::setPlaceHolder($pageTemplate, "MainContent", $correctPass);
else {
    \Services::setPlaceHolder($beforePassword, "error", "");
    \Services::setPlaceHolder($pageTemplate, "MainContent", $beforePassword);
}
//////////////////////////////////////////

////////////Search Table///////////////
if(!empty($dBRes)) {
    $usersTable = <<<EducationTable
    <div class="row profile-tables">
        <div class="col-sm-10 col-sm-offset-1">
            <h3>ממתינים לאישור:</h3>
            <table class="table" style="cursor: default;">
                <thead>
                  <tr>
                    <th>ת"ז</th>
                    <th>מספר אישי</th>
                    <th>שם מלא</th>
                    <th>אישור</th>
                  </tr>
                </thead>
                <tbody>
                    {SearchTable}
                </tbody>
              </table>
        </div>
    </div>
EducationTable;


    $useresAllRows = <<<SearchTable
<tr style="cursor: default;">
    <td style="cursor: default;">{userId}</td>
    <td style="cursor: default;">{userPersonalNumber}</td>
    <td style="cursor: default;">{userFullName}</td>
    <td style="cursor: default;"><span class="glyphicon glyphicon-ok" onclick="document.location = 'confirm-users.php?userToConfirm={userId}';" style="cursor: pointer"></span></td>
</tr>
SearchTable;

    $userRow = "";
    foreach ($dBRes as $index => $res) {
        $userObj = User::GetById($res["Id"]);
        $userRow .= $useresAllRows;
        \Services::setPlaceHolder($userRow, "userId", $userObj->GetId());
        \Services::setPlaceHolder($userRow, "userPersonalNumber", $userObj->GetPersonalNumber());
        \Services::setPlaceHolder($userRow, "userFullName", $userObj->GetFullName());
    }
    \Services::setPlaceHolder($usersTable, "SearchTable", $userRow);
    \Services::setPlaceHolder($pageTemplate, "SearchBigTable", $usersTable);
} else {
    \Services::setPlaceHolder($pageTemplate, "SearchBigTable", "<center><h2>לא קיימים רשומים חדשים!</h2></center><br>");
}
//////////////////////////////////////



if(isset($_GET["userToConfirm"])){
    try{
        $newUser = User::GetById($_GET["userToConfirm"]);
        $newUser->Approve();

        $message = EmailsConstant::User_approve;
        \Services::setPlaceHolder($message, "userName", $newUser->GetFirstName());
        $subject = "המשתמש שלך אושר! בוא ותתחיל להנות!";
        $newUser->SendEmail($message, $subject);

        //log
        $logString = "המשתמש <b>{$newUser->GetFullName()}</b> תז <b>{$newUser->GetId()}</b> אושר כחבר עמותה על ידי המשתמש <b>{$userMainObj->GetFullName()}</b> תז <b>{$userMainObj->GetId()}</b>";
        Rimon::NewLog($logString);

    }catch (\Throwable $e){
        echo $e->getMessage();
    }
    header("Location: confirm-users.php");
}


$pageTemplate .= footerTemplate;
echo $pageTemplate;
