<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 27-Jan-18
 * Time: 19:20
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "תרום לעמותה");
$pageTemplate .= bodyTemplate;


if(isset($_SESSION["UserId"]))
    \Services::setPlaceHolder($pageTemplate,"Menu", familyMenu);
else
    \Services::setPlaceHolder($pageTemplate,"Menu", officialMenu);

\Services::setPlaceHolder($pageTemplate,"manageMenu", "");



if(empty($_SESSION["FlashText"]))
    \Services::RedirectHome();

$pageTemplate .=
    <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/unitrandom{$GLOBALS["RANDOM_PAGE_IMAGE"]}.jpg">
        </div>  
    </div>

    <div class="row" style="padding: 40px 0">
        <div class="col-sm-10 col-sm-offset-1">
            <p style="text-align: center">
                {flashText}
            </p>    
        </div>
    </div>
   

</div>

<script>
    window.setTimeout(function(){
        window.location.href = "index.php";
    }, 5000);
</script>
Index;


$flashText = $_SESSION["FlashText"];

\Services::setPlaceHolder($pageTemplate,"flashText",$flashText);
unset($_SESSION["FlashText"]);

$pageTemplate .= footerTemplate;
echo $pageTemplate;
