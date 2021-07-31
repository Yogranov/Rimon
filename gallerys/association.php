<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 13-Jan-18
 * Time: 14:15
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "גלריית העמותה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


$pageTemplate .= <<<Index
<script type='text/javascript' src='https://845.co.il/media/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/teams.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row" style="direction: ltr; margin-bottom: 20px">
        <div class="col-sm-12"> 
            <h2 style="direction: rtl">גלריית העמותה</h2>
            <div id="gallery" style="display:none;">
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(1).jpeg"
                     data-image="../media/gallerys/association/big/association (1).jpeg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(1).jpg"
                     data-image="../media/gallerys/association/big/association (1).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(2).jpeg"
                     data-image="../media/gallerys/association/big/association (2).jpeg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(2).jpg"
                     data-image="../media/gallerys/association/big/association (2).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(3).jpeg"
                     data-image="../media/gallerys/association/big/association (3).jpeg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(3).jpg"
                     data-image="../media/gallerys/association/big/association (3).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(4).jpg"
                     data-image="../media/gallerys/association/big/association (4).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(5).jpg"
                     data-image="../media/gallerys/association/big/association (5).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(6).jpg"
                     data-image="../media/gallerys/association/big/association (6).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(7).jpg"
                     data-image="../media/gallerys/association/big/association (7).jpg"
                     style="display:none">
                </a>
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(8).jpg"
                     data-image="../media/gallerys/association/big/association (8).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(9).jpg"
                     data-image="../media/gallerys/association/big/association (9).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(10).jpg"
                     data-image="../media/gallerys/association/big/association (10).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(11).jpg"
                     data-image="../media/gallerys/association/big/association (11).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(12).jpg"
                     data-image="../media/gallerys/association/big/association (12).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(13).jpg"
                     data-image="../media/gallerys/association/big/association (13).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(14).jpg"
                     data-image="../media/gallerys/association/big/association (14).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(15).jpg"
                     data-image="../media/gallerys/association/big/association (15).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(16).jpg"
                     data-image="../media/gallerys/association/big/association (16).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(17).jpg"
                     data-image="../media/gallerys/association/big/association (17).jpg"
                     style="display:none">
                </a>
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(18).jpg"
                     data-image="../media/gallerys/association/big/association (18).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(19).jpg"
                     data-image="../media/gallerys/association/big/association (19).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(20).jpg"
                     data-image="../media/gallerys/association/big/association (20).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(21).jpg"
                     data-image="../media/gallerys/association/big/association (21).jpg"
                     style="display:none">
                </a>
        
                <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(22).jpg"
                     data-image="../media/gallerys/association/big/association (22).jpg"
                     style="display:none">
                </a>
                
                        <a href="http://unitegallery.net">
                <img alt=""
                     src="../media/gallerys/association/thumbnail/thumbnail%20(23).jpg"
                     data-image="../media/gallerys/association/big/association (23).jpg"
                     style="display:none">
                </a>
        
                     
            </div>
        
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#gallery").unitegallery();
                });
            </script>
        </div>
    </div>
            

</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
