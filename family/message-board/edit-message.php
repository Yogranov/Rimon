<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 17-Mar-18
 * Time: 13:35
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "עריכת מודעה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

try{
    $messageObj = MessageBoard::GetById($_GET["MessageId"]);
} catch (\Throwable $e){
    \Services::RedirectHome();
}

if(isset($_POST["edit-new-message-submit"])) {
    if(!empty($_POST["edit-new-message-title"]) && !empty($_POST["edit-new-message-content"])) {
        $userObj = User::GetById($_SESSION["UserId"]);

        $arrayToUpdate = array("Title" => $_POST["edit-new-message-title"],
            "Content" => $_POST["edit-new-message-content"],
            "Status" => 1
        );
        try {
            $messageObj->Update($arrayToUpdate);
            $success = true;
        } catch (\Throwable $e) {
            echo $e->getMessage();
            $success = false;
        }
        //Image Upload
        if(isset($_FILES["edit-new-message-image"])) {

            $image = $_FILES["edit-new-message-image"];
            $fileExt = explode(".", $image["name"]);
            $fileActualExt = strtolower(end($fileExt));
            $allowedFormats = array('jpg','jpeg');

            if (in_array($fileActualExt, $allowedFormats) && $image["type"] === "image/jpeg") {
                if ($image["error"] === 0) {
                    if ($image["size"] < 500000) {
                        $newFileName = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'uploads/' . $newFileName;
                        move_uploaded_file($image['tmp_name'], $fileDestination);
                        try {
                            $messageObj->Update(array("Image" => $newFileName));
                            $success = true;
                        } catch (\Throwable $e) {
                            echo $e->getMessage();
                            $success = false;
                        }
                    } else {
                        $error = "הקובץ חייב להיות קטן מ500 קילובייט";
                    }
                } else {
                    $error = "אירע שגיאה במהלך העלאת הקובץ, אנא נסה שוב שנית.";
                }
            } else {
                $error = "פורמט הקובץ חייב להיות jpg או jpeg.";
            }
        }
    }

    if($success) {
        //log
        $logString = "המודעה <b>{$messageObj->GetTitle()}</b> נערכה על ידי המשתמש <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
        Rimon::NewLog($logString);
        header("Location: board.php");
    }
}
/*


 */
$pageTemplate .= <<<Index
<div class="container content">

    <div class="row">
        <div class="col-sm-12 page-photo">
            <img src="../../media/pages/projects-race-1.jpg">
        </div>  
    </div>
    
    <div class="row">
        <div class="col-sm-12 pull-right" style="width: 100%">
            <h2 class="subtitles" data-aos="zoom-in">הוספת מודעה</h2>
            <p>{$error}</p>
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-10 col-sm-offset-1">
           <form method="POST" role="form" enctype="multipart/form-data"> 
              
               <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-new-message-title">כותרת</label>
                          <input type="text" class="form-control" id="edit-new-message-title" name="edit-new-message-title" value="{$messageObj->GetTitle()}" required>
                     </div>
               </div>
               
               <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-new-message-image">תמונה</label>
                          <input type="file" class="form-control-file" id="edit-new-message-image" name="edit-new-message-image">
                     </div>
               </div>
               
               <div class="col-sm-12">
                     <div class="form-group">
                          <label for="edit-new-message-content">תוכן המודעה</label>
                    <textarea id="edit-new-message-content" name="edit-new-message-content" class="form-control" required>{$messageObj->GetContent()}</textarea>
                     </div>
               </div>
               
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                    <input type="submit" value="עדכן מודעה" name="edit-new-message-submit" class="btn btn-info btn-block">
                </div>  
                
           </form> 
        </div>
    </div>
        
        
    </div>
Index;



$pageTemplate .= footerTemplate;
echo $pageTemplate;
