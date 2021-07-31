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
\Services::setPlaceHolder($pageTemplate, "PageTitle", "גלריית היחידה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


$pageTemplate .= <<<Index
<script type='text/javascript' src='https://845.co.il/media/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom3.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row" style="direction: ltr; margin-bottom: 20px">
        <div class="col-sm-12"> 
            <h2 style="direction: rtl">גלריית היחידה</h2>
	        <div id="gallery" style="display:none;">

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(1).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(1).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(2).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(2).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(3).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(3).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(4).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(4).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(5).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(5).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(6).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(6).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(7).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(7).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(8).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(8).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(9).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(9).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(10).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(10).jpg"
		     style="display:none">
		</a>		
		
		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(11).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(11).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(12).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(12).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(13).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(13).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(14).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(14).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(15).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(15).jpg"
		     style="display:none">
		</a>		
		
		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(16).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(16).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(17).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(17).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(18).JPG"
		     data-image="../media/gallerys/unit/big/unit%20(18).JPG"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(19).JPG"
		     data-image="../media/gallerys/unit/big/unit%20(19).JPG"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(20).JPG"
		     data-image="../media/gallerys/unit/big/unit%20(20).JPG"
		     style="display:none">
		</a>		
		
		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(21).JPG"
		     data-image="../media/gallerys/unit/big/unit%20(21).JPG"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(22).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(22).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(23).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(23).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(24).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(24).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(25).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(25).jpg"
		     style="display:none">
		</a>		
		
		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(26).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(26).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(27).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(27).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(28).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(28).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(29).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(29).jpg"
		     style="display:none">
		</a>

		<a href="http://unitegallery.net">
		<img alt=""
		     src="../media/gallerys/unit/thumbnail/unit%20(30).jpg"
		     data-image="../media/gallerys/unit/big/unit%20(30).jpg"
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
