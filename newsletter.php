<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 10/01/2018
 * Time: 10:46
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "ניוזלטר");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/teams.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row">
        <div class="col-sm-12">
        <h2>ניוזלטר חודש - מאי 2017</h2>
        <br>
        <iframe src="https://845.co.il/newsite/newsletters/2017_05_newsletter.pdf" width="100%" height="1200px"></iframe>
        
        </div>
    </div>
            
            
            

    
    
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
