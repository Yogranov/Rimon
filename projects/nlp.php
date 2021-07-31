<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09/01/2018
 * Time: 18:07
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "סדנת משוחררים");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<script type='text/javascript' src='https://845.co.il/media/unitegallery/themes/carousel/ug-theme-carousel.js'></script>
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/nlp.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">סדנת משוחררים 2016. 16/12/16</h2>   
                <p>בסוף שבוע האחרון נערכה בפעם הראשונה סדנה מקצועית המיועדת למשוחררים ולעתידים להשתחרר מן היחידה.</p>
                <p>הסדנה נערכה בכפר סבא והועברה על ידי תמי ציפורי, שם דבר בעולם הNLP. שזה אגב ניתוב לשוני פיזיולוגי, או באנגלית Neuro-linguistic programming. זאת בעצם שיטה המציעה מגוון טכניקות ומיומנויות פסיכולוגיות שמטרתן יצירת השפעה ושינוי במחשבות, רגשות והתנהגויות.</p>
                <p>בסוף ההרצאה הבוגרים יצאו עם כלים שונים וקיבלו פוסטר “השנה המנצחת שלי” ענק עם מקום להציב לעצמם תאריך להצלחה הבאה!</p>
                <p>לאחר ההרצאה המדהימה של תמי, עברנו להרצאה של בוגר היחידה, יותם אברהמי – סטודנט ומתנדב בעמותת פעמונים. יותם העביר הרצאה מדהימה על כספים והתנהלות פיננסית נכונה.</p>
                <p>אחריו עלה בוגר היחידה, איתן גרוס, שהעביר הרצאה מעולה על ביטוח לאומי, פנסיה, הקרנות השונות, המחאות ועוד הרבה דברים שלא מלמדים את החיילים לקראת האזרחות.</p>
                <p>
                    <ul style="font-size: 18px">אז מה למדו המשוחררים שלנו?</ul>
                        <li>הדרך אל האושר -> להציב לעצמנו מול העיניים את התוצאה שאליה נגיע.</li>
                        <li>חשיבה חיובית והדרך לפתור כל בעיה שתעמוד בדרכנו.</li>
                        <li>פיתוח זווית ראיה רחבה.</li>
                        <li>נוסחה ומרשם להצלחה!</li>
                        <li>התנהלות פיננסית נבונה.</li>
                        <li>מושגי מפתח לאזרחות – ביטוח לאומי, קרנות פנסיה, המחאות ועוד!</li>
                </p>
                <p>נסכם ונגיד שהייתה סדנה מוצלחת ביותר, הבוגרים שלנו יצאו עם שלל כלים שילוו אותם במהלך החיים.
                    <br>
                    תודה רבה לכל מי שהגיע,
                    <br>
                    נתראה בסדנה הבאה!
                </p>
            
            
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/nlp.jpg">
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">    
                <div id="gallery" style="display:none;">
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(1).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(1).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(2).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(2).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(3).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(3).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(4).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(4).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(5).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(5).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(6).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(6).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(7).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(7).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(8).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(8).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(9).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(9).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(10).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(10).jpg"
                         style="display:none">		
             
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(11).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(11).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(12).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(12).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(1).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(1).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(13).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(13).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(14).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(14).jpg"
                         style="display:none">
                                     
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(15).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(15).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(16).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(16).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(17).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(17).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(18).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(18).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(19).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(19).jpg"
                         style="display:none">
                
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(20).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(20).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(21).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(21).jpg"
                         style="display:none">
            
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(22).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(22).jpg"
                         style="display:none">
                         
                    <img alt=""
                         src="../media/gallerys/projects/nlp/thumbnail/nlp%20(23).jpg"
                         data-image="../media/gallerys/projects/nlp/big/nlp%20(23).jpg"
                         style="display:none">
                </div>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#gallery").unitegallery();});
	</script>
            
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
