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
\Services::setPlaceHolder($pageTemplate, "PageTitle", "חלוקת משלוחי מנות");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/lone-solider.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">חלוקת משלוחי מנות ללוחמים לקראת פורים 15/03/2017</h2>   
                <p>חג פורים שמח חברים!</p>
                <p>אז לחלקנו החג עבר אבל צוות “האח הגדול” לא שכח את הלוחמים היקרים וקפץ לקיים את מצוות החג – חלוקת משלוחי מנות .</p>
                <p>אז מה היה ?</p>
                <p>כמה מבוגרי היחידה הגיעו ליחידה ביום שני בערב , שוחחו עם הלוחמים ולאחר מכן נכנסו לערב יחידה עם תחרות תחפושות ומשחקים בין הצוותים (כמובן שצוות האח הגדול התחרה) ולסיום חולקו משלוחי המנות.</p>
                <p>כמה תודות:<br>
                    תודה  לסקוני ישראל! אנחנו רוצים להודות לביה”ס היסודי “רעות” מהוד השרון על התרומה הרבה של כל משלוחי המנות .
                    <br>
                    2. לבוגרי היחידה שלקחו חלק בערב השמח הזה – מתן אבי , אור שמואלי , אליאב שמס , דניאל פוליטי, אברם סלה אלירן אליאס, ולעיטם!
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/mishloach-manot.jpg">
            </div>
        </div>
    </div>
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
