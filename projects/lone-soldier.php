<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09/01/2018
 * Time: 17:02
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "ערב חיילים בודדים");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<script type='text/javascript' src='https://845.co.il/media/unitegallery/themes/carousel/ug-theme-carousel.js'></script>
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/lone-solider.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">ערב חיילים בודדים מכל הזמנים 25/12/16</h2>   
                <p>לכבוד חג החנוכה החלטנו לקיים אירוע מיוחד במינו – ערב חיילים בודדים מכל הזמנים!</p>
                <p>כ-20 חיילים בודדים שמשרתים או שירתו ביחידה הגיעו לערב המיוחד הזה, כל אחד והרקע שלו. עולים חדשים, חרדים לשעבר, בעלי עבר פלילי, כולם באו במטרה ללמוד וללמד אחד מניסיונו של השני. הדו שיח האמיתי שהתקיים בין הצדדים התבסס כל כולו על תחושת המשפחתיות והאחווה ההדדית שמתקיימת במשפחת רימון.</p>
                <p>התחלנו בארוחת ערב חגיגית במסעדה בכפר שמריהו, שם התחברו והתגבשו הדורות השונים של החיילים בודדים מהיחידה. כל אחד שיתף סיפר על חוויותיו מהשירות הצבאי ומחיי האזרחות שלאחר מכן. אחרי קצת גיבוש ואוכל טוב, קיבלו כלל המשתתפים שי קטן לחג באדיבות חברת WOODIES.</p>
                <p>לאחר המסעדה המשכנו את הערב ב”בית קינן”, באירוע של “הרצליה למען תושביה” ברשותו של ד”ר שמואל סעדיה – נשיא העמותה. באירוע נכחו מכובדים שונים ביניהם אביגדור קהלני ודני יתום ששיבחו את חברי העמותה על הקרבתם האישית היוצאת דופן למען הכלל.</p>
                <p>בסוף הערב, ולאחר לא מעט סופגניות, העניקו נציגי העמותה שני מחשבים ניידים לג’וש קקון ושמואל מירסקי, בוגרי היחידה שהיו חיילים בודדים במהלך שירותם הצבאי. </p>
                <p>אירועים מסוג זה מראים לנו את הפסיפס המיוחד ממנו מורכבת יחידת רימון וצה”ל בכלל. אמנם זאת הפעם הראשונה שקיימנו ערב כל כך מיוחד, אך אין לנו ספק שזאת לא האחרונה.</p>
                <p>תודה מיוחדת מגיעה לד”ר שמואל סעדיה- נשיא העמותה, שבאדיבותו הרבה זכינו לקיים ערב מיוחד שכזה.</p>
                <p>נתראה באירוע הבא!</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/lone-soldier.jpg">
            </div>
        </div>
    </div>
    
            <div class="row">
            <div class="col-sm-12">    
                <div id="gallery" style="display:none;">
                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(1).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(1).jpg"
                         style="display:none">

                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(2).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(2).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(3).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(3).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(4).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(4).jpg"
                         style="display:none">   
                                      
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(5).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(5).jpg"
                         style="display:none">
                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(6).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(6).jpg"
                         style="display:none">

                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(7).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(7).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(8).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(8).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(9).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(9).jpg"
                         style="display:none">   
                                      
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(10).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(10).jpg"
                         style="display:none">
                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(11).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(11).jpg"
                         style="display:none">

                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(12).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(12).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(13).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(13).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(14).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(14).jpg"
                         style="display:none">   
                                      
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(15).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(15).jpg"
                         style="display:none">
                                         
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(16).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(16).jpg"
                         style="display:none">

                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(17).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(17).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(18).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(18).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(19).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(19).jpg"
                         style="display:none">   
                                      
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(20).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(20).jpg"
                         style="display:none">
                                         
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(21).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(21).jpg"
                         style="display:none">

                
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(22).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(22).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(23).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(23).jpg"
                         style="display:none">  
                                       
                    <img alt=""
                         src="../media/gallerys/projects/lone-soldiers/thumbnail/lone-soldiers%20(24).jpg"
                         data-image="../media/gallerys/projects/lone-soldiers/big/lone-soldiers%20(24).jpg"
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
