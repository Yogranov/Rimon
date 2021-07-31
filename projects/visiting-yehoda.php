<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 09-Jan-18
 * Time: 22:57
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "ביקור יהודה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/visiting-yehoda.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">ביקור יהודה ישראלי</h2>   
                <p>לקראת ראש השנה תשע”ה, ארגנו חברי העמותה ביקור אצל פצוע של היחידה – יהודה ישראלי.</p>
                <p>מבצע “צוק איתן” תפס את יהודה בהכנה לקורס קצינים. לא עזרו כל תחנוניו למפקדים להצטרף לחבריו שלוחמים ברצועת עזה, והמצב הזה היה קשה לו ביותר. כשסוף־סוף הסתיימה ההכנה, בחופשה שלפני קורס הקצינים, התרצו המפקדים ובמקום לנפוש עם אשתו ובתו יהודה הצטרף ללוחמה בעזה. יהודה ישראלי נפצע ביום שישי השחור, בכניסה ללחימה ברפיח ובעקבות חטיפתו של הדר גולדין ז”ל.</p>
                <p>במהלך הביקור, ראינו את יהודה ואת משפחתו והענקנו להם מתנה לחג מטעם העמותה. משפחת ישראלי שמחה מאוד על ביקורינו ואנו הבטחנו לשמור על קשר. אבא של יהודה ביקש מאתנו לא לצלם תמונות, אז ביקשנו ממנו לפחות תמונה אחת רק איתו.</p>
                <p>אנו רואים זאת כחובה מוסרית, לשמור על קשר ולבוא לשמח את אלה שלחמו איתנו כתף אל כתף. יהודה ישראלי ומשפחתו הם חלק בלתי נפרד ממשפחת רימון ואנו נעשה ככל שביכולתנו על מנת לסייע להם.</p>
                <p>לאחר המבצע כתבו לוחמי היחידה, דולב ששון ודניאל פרידמן שיר לכבודו.</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/visiting-yehoda.jpg">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 pull-right">
                <iframe style="width: 100%; height: 300px; ;border-radius: 10px" src="https://www.youtube.com/embed/57C-Ew7ggpI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="col-sm-6">
                <p style="font-size: 24px">מחכים לך / דולב ששון ודניאל פרידמן</p>
                <p style="font-size: 22px">
                    כואב ומחזק גם יחד, לראות אותך במצבך <br>
                    כחוש אתה וגם רזה, אך חזק בתוכך. <br>
                    לצדך עומדים הוריך, לצדך גם אשתך <br>
                    ילדים קטנים בבית, מחכים הם רק לך. <br>
                </p>
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
