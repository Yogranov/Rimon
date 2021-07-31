<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09/01/2018
 * Time: 16:46
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "מירוץ רימון ה-1");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<script type='text/javascript' src='https://845.co.il/media/unitegallery/themes/carousel/ug-theme-carousel.js'></script>
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/projects-race-1.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">מירוץ רימון ה-1 19/05/2017</h2>   
                <p>ב19/05/2017 התרחשה היסטוריה נוספת בתולדות היחידה. מירוץ רימון הראשון!!</p>
                <p>המירוץ נערך בשוהם בנוכחות היחידה וכ150 לוחמי מילואים שבאו לתת כבוד להיסטוריה בהתהוות ולפגוש קצת פרצופים מוכרים מהשירות הסדיר.</p>
                <p>מאות הרצים שהשתתפו במירוץ התלהבו מאד לראות את היחידה מוסיפה הרבה שמחה ורעש לאירוע.</p>
                <p>חולצות דרייפיט מקצועיות של סקוני עם הדפס של היחידה חולקו באירוע, ומי שרצה אפילו קפץ אחרי המירוץ להתחדש בזוג נעליים בחנות של סקוני (עם הנחה בלעדית לחברי העמותה!).</p>
                <p>תודות מיוחדות:<br>
                    תודה  לסקוני ישראל שהכינו לנו את החולצות ונתנו לנו הנחות משמעותיות בחנות הרשמית. התמיכה מסקוני שראינו ביום המירוץ מתווספת לתמיכה שהם נותנים לנו גם ביום יום, כולל הנחה קבועה לחברי העמותה. תודה רבה סקוני!
                    <br>
                    תודה לקראפט על אירגון האירוע, על התרומה המשמעותית והעזרה הגדולה שניתנת לעמותה. ישר כח!
                    <br>
                    תודה לקראפט על אירגון האירוע, על התרומה המשמעותית והעזרה הגדולה שניתנת לעמותה. ישר כח!
                    <br>
                    וכמובן למועצה איזורית שוהם על האירוח החם שניתן לנו. אנו מקווים שזה תחילתו שיתוף פעולה ארוך שנים.
                    </p>
                    <p>שמחנו לראות את כולכם שם ומקווים לראות אתכם גם בכנס רימון ה-3</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/rimon-race-1.jpg">
            </div>
        </div>
    </div>
    
        <div class="row">
            <div class="col-sm-12">    
                <div id="gallery" style="display:none;">
                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(1).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(1).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(2).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(2).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(3).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(3).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(4).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(4).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(5).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(5).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(6).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(6).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(7).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(7).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(8).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(8).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(9).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(9).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(10).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(10).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(11).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(11).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(12).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(12).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(13).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(13).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(14).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(14).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(15).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(15).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(16).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(16).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(17).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(17).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(18).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(18).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(19).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(19).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(20).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(20).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(21).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(21).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(22).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(22).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(23).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(23).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(24).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(24).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(25).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(25).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(26).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(26).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(27).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(27).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(28).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(28).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(29).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(29).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(30).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(30).jpg"
                         style="display:none">                
                
                    <img alt=""
                         src="../media/gallerys/projects/rimon-race-1/thumbnail/rimon-race-1%20(31).jpg"
                         data-image="../media/gallerys/projects/rimon-race-1/big/rimon-race-1%20(31).jpg"
                         style="display:none">                
                
                </div>
	
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery("#gallery").unitegallery();});
                </script>
            
            </div>
        </div>
    
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
