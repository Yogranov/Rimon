<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 16-Mar-18
 * Time: 14:15
 */

namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "מודעה חדשה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

if(isset($_POST["add-new-message-submit"])) {
    if(!empty($_POST["add-new-message-title"]) && !empty($_POST["add-new-message-content"]) && !empty($_FILES["add-new-message-image"])) {
        $userObj = User::GetById($_SESSION["UserId"]);
        $time = new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
        $image = $_FILES["add-new-message-image"];

        $fileExt = explode(".", $image["name"]);
        $fileActualExt = strtolower(end($fileExt));

        $allowedFormats = array('jpg','jpeg');

        if(in_array($fileActualExt, $allowedFormats) && $image["type"] === "image/jpeg") {
            if($image["error"] === 0) {
                if($image["size"] < 500000){
                    $newFileName = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'uploads/' . $newFileName;
                    move_uploaded_file($image['tmp_name'], $fileDestination);

                    $arrayToInsert = array("Title" => $_POST["add-new-message-title"],
                        "Content" => $_POST["add-new-message-content"],
                        "Image" => $newFileName,
                        "OpenBy" => $userObj->GetId(),
                        "OpenDate" => $time->format("Y-m-d H:i:s"),
                        "Status" => 1
                    );

                    try {
                        MessageBoard::Add($arrayToInsert);
                        //log
                        $logString = "מודעה חדשה (<b>{$_POST["add-new-message-title"]}</b>) נוצרה על ידי <b>{$userObj->GetFullName()}</b> תז <b>{$userObj->GetId()}</b>";
                        Rimon::NewLog($logString);

                        header("Location: board.php");
                    } catch (\Throwable $e) {
                        echo $e->getMessage();
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
                          <label for="add-new-message-title">כותרת</label>
                          <input type="text" class="form-control" id="add-new-message-title" name="add-new-message-title" placeholder="כותרת המודעה" required>
                     </div>
               </div>
               
               <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-new-message-image">תמונה</label>
                          <input type="file" class="form-control-file" id="add-new-message-image" name="add-new-message-image" required>
                     </div>
               </div>
               
               <div class="col-sm-12">
                     <div class="form-group">
                          <label for="add-new-message-content">תוכן המודעה</label>
                    <textarea id="add-new-message-content" name="add-new-message-content" class="form-control" required>תוכן המודעה..</textarea>
                     </div>
               </div>
               
                <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px">                   
                    <input type="submit" value="צור מודעה" name="add-new-message-submit" class="btn btn-info btn-block">
                </div>  
                
           </form> 
        </div>
    </div>
        
        
    </div>
Index;



$pageTemplate .= footerTemplate;
echo $pageTemplate;
