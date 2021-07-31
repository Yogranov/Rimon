<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 11-Jan-18
 * Time: 12:41
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "תרום לעמותה");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


$pageTemplate .=
    <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/donate.jpg">
        </div>  
    </div>

    <div class="donate-page">
        <div class="row">
             <div class="col-sm-7 pull-right" data-aos="fade-up">
                <h2 class="subtitles">תרומה לעמותה</h2>
                <p>אם הגעתם לכאן סימן שאתם מכירים אותנו, ואולי כדאי שתדעו כמה דברים. מהקמת העמותה ועד היום קיימה העמותה פעילות רבה מאוד. קיימנו כנסי משוחררים, הגענו ליחידה לפנק את הלוחמים בכל טוב, עזרנו לחיילים מעוטי יכולת ועוד.</p>
                <p>כל זה קרה על בסיס טוב הלב של כל הגורמים שעבדנו מולם. בין אם זה נהג משאית שתרם מזמנו כדי להוביל מיטה לחייל שחסר לו או מלון שנתן לנו בתרומה מקום לקיים בו כנס, כל פעילותנו נעשתה ללא משאבים מצד העמותה. העבודה ללא משאבים אפשרית, אך מקשה עלינו מאד. לנו ברור שאם ברצוננו להרחיב את פעילות העמותה אנו צריכים לגייס כספים.</p>
                <p>התרומות שמתקבלות משמשות אותנו לקדם את מטרותינו, בתחומים למשרתים ביחידה וגם למשוחררים ממנה.</p>
            </div>
             <div class="col-sm-5" data-aos="zoom-in">
                <img src="media/random/handshake.jpg">
            </div>
        </div>
        <div class="row">
             <div class="col-sm-5 pull-right" data-aos="zoom-in">
                <img src="media/random/laptops-lone.jpg">
            </div>
             <div class="col-sm-7" data-aos="fade-down">
                <h4><b>להלן דוגמאות לדברים שנעשה/ נעשו עם התרומות:</b></h4>
                <p>
                    <ul>
                        <li>סיוע לחיילים בודדים / מעוטי יכולת ע”י השלמת מוצרי בית בסיסיים, כדוגמת:    מיטה, מכונת כביסה,מקרר ועוד.</li>
                        <li>תכנית מלגות שתסייע לבוגרי היחידה לממש את שאיפותיהם בעולם האקדמיה.</li>
                        <li>קניית מתנות סמליות למסיימי מסלול הלוחם ביחידה.</li>
                        <li>קיום כנסי הכוונה לאזרחות אשר יסייעו למשוחררים להשיג את מטרותיהם.</li>
                        <li>הקמת פרויקט תרומה לקהילה אשר ישלב בתוכו את בוגרי היחידה.</li>
                    </ul>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1" data-aos="fade-up">
                <p>אנו רוצים להודות לכם שהקדשתם מזמנכם ומכספכם כדי לסייע לעמותת בוגרי רימון. אנו מבטיחים לכם שלתרומתכם יש השפעה ישירה על משפחת רימון, בין אם זה חייל שחסר לו מיטה חמה, או משוחרר טרי שמחפש דרך להגשים את עצמו. אתם חלק בלתי נפרד מההצלחה של כולנו! <br><b>שוב פעם, תודה!</b></p>
            </div>
        </div>
    </div>
   

</div>


Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
