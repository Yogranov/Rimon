<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 04-Feb-18
 * Time: 14:02
 */

namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "הוצאת רישיון");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);



$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/weapon-license.jpg" style="margin: 0">
        </div>  
    </div>
        
    <div class="rimon-meeting-3">
    
        <div class="row">
            <div class="col-sm-7 pull-right" data-aos="zoom-in">
                <h2 style="color: #800000; font-weight: bold">מבצע בוגר חמוש</h2>   
                <p>אחרי כמעט שנה של שחייה בביורוקרטיה סבוכה ומורכבת, הוצאנו לפועל יום הנפקה מרוכז לרישיונות נשק פרטיים.</p>
                <p>במהלך היום עברו חברי העמותה ראיון עם נציגי המשרד לביטחון פנים, שיעור עקרונות אקדח, אימון ירי מעשי, ולבסוף רכשו המשתתפים בקניה מרוכזת אקדח מסוג Glock.</p>
                <p>עמותת בוגרי רימון גאה ב-21 בוגרי היחידה שגם לאחר השירות הצבאי בוחרים לקחת חלק פעיל בשמירה על ביטחון אזרחי ישראל.</p>
                <p>תודה רבה ל- משרד לביטחון פנים ולמ.א. רוי עין צורים, בלעדיכם היום הזה לא היה קורה!בוגרים יקרים, אחריות גדולה מונחת על כתפיכם, מקווים שלא תצטרכו לממש אותה.שמרו על עצמכם ועל הסובבים אתכם.</p>
                <p>עמותת רימון – עמותה שהיא משפחה</p>
            </div>
            <div class="col-sm-5" data-aos="zoom-in">
                <img src="../media/projects/weapon-license.jpg">
            </div>
        </div>
    </div>
    
       
            
            </div>
        </div>
    
</div>

Index;


$pageTemplate .= footerTemplate;
echo $pageTemplate;
