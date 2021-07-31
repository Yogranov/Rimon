<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 29-Jan-18
 * Time: 22:12
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "חיפוש משתמשים");
$pageTemplate .= bodyTemplate;


$permissions = Rimon::GetPermissions(5);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$error = "";
if(isset($_REQUEST["search-users-submit"]) && Token::Check($_REQUEST["search-users-manager-token"])){
    if(strlen($_REQUEST["search-users-id"]) > 1 ||
        strlen($_REQUEST["search-users-email"]) > 1 ||
        strlen($_REQUEST["search-users-first-name"]) > 1 ||
        strlen($_REQUEST["search-users-last-name"]) > 1 ||
        strlen($_REQUEST["search-users-phone-number"]) > 1 ||
        strlen($_REQUEST["search-users-personal-number"]) > 1) {

        $searchRes = Rimon::GetDB()->where("Id", "%" . $_REQUEST["search-users-id"] . "%", 'like')
            ->Where("Email", "%" . $_REQUEST["search-users-email"] . "%", 'like')
            ->Where("FirstName", "%" . $_REQUEST["search-users-first-name"] . "%", 'like')
            ->Where("LastName", "%" . $_REQUEST["search-users-last-name"] . "%", 'like')
            ->Where("PhoneNumber", "%" . $_REQUEST["search-users-phone-number"] . "%", 'like')
            //->Where("PersonalNumber", "%" . $_REQUEST["search-users-personal-number"] . "%", 'like')
            ->get("users", null, "Id");

        if (empty($searchRes))
            $error = "לא נמצאו תוצאות.";
    } else
        $error = "מילת חיפוש חייבת להכיל לפחות 2 תווים.";
}

$token = Token::Generate();
$pageTemplate .= <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom7.jpg">
        </div>  
    </div>

    <div class="row" style="padding: 40px 0">
        <div class="col-sm-10 col-sm-offset-1">
           <h2 class="subtitles">חיפוש משתמשים</h2>
           <p>{$error}</p>
           <form method="GET" role="form">
                <div class="row">
                
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="search-users-id">תעודת זהות</label>
                        <input type="text" class="form-control" id="search-users-id" name="search-users-id" placeholder="123456">
                        </div>                                
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="search-users-email">דוא"ל</label>
                        <input type="text" class="form-control" id="search-users-email" name="search-users-email" placeholder="abcd@abcd.com">
                        </div>                                
                    </div> 
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="search-users-first-name">שם פרטי</label>
                        <input type="text" class="form-control" id="search-users-first-name" name="search-users-first-name" placeholder="שם פרטי">
                        </div>                                
                    </div> 
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="search-users-last-name">שם משפחה</label>
                        <input type="text" class="form-control" id="search-users-last-name" name="search-users-last-name" placeholder="שם משפחה">
                        </div>                                
                    </div> 
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="search-users-phone-number">מספר טלפון</label>
                        <input type="text" class="form-control" id="search-users-phone-number" name="search-users-phone-number" placeholder="0501234567">
                        </div>                                
                    </div> 
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="submit" value="חפש" name="search-users-submit" class="btn btn-info btn-block">
                </div>
                <input type="hidden" name="search-users-manager-token" value="{$token}">
           </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {SearchBigTable}
        </div>
    </div>
</div>
Index;

////////////Search Table///////////////
if(!empty($searchRes)) {
    $searchTable = <<<EducationTable
    <div class="row profile-tables">
        <div class="col-sm-10 col-sm-offset-1">
            <h3>תוצאות החיפוש</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th>ת"ז</th>
                    <th>שם פרטי</th>
                    <th>שם משפחה</th>
                    <th>פלאפון</th>
                  </tr>
                </thead>
                <tbody>
                    {SearchTable}
                </tbody>
              </table>
        </div>
    </div>
EducationTable;


    $searchAllRows = <<<SearchTable
<tr onclick="document.location = '../user/profile.php?userid={userId}';" style="cursor: pointer">
    <td>{userId}</td>
    <td>{userFirstName}</td>
    <td>{userLastName}</td>
    <td>{userPhoneNumber}</td>
</tr>
SearchTable;

    $searchRow = "";
    foreach ($searchRes as $index => $res) {
        $userObj = User::GetById($res["Id"]);
        $searchRow .= $searchAllRows;
        \Services::setPlaceHolder($searchRow, "userId", $userObj->GetId());
        \Services::setPlaceHolder($searchRow, "userFirstName", $userObj->GetFirstName());
        \Services::setPlaceHolder($searchRow, "userLastName", $userObj->GetLastName());
        \Services::setPlaceHolder($searchRow, "userPhoneNumber", $userObj->GetPhoneNumber());
    }
    \Services::setPlaceHolder($searchTable, "SearchTable", $searchRow);
    \Services::setPlaceHolder($pageTemplate, "SearchBigTable", $searchTable);
} else {
    \Services::setPlaceHolder($pageTemplate, "SearchBigTable", "");
}
//////////////////////////////////////




$pageTemplate .= footerTemplate;
echo $pageTemplate;
