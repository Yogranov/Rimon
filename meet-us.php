<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 11-Jan-18
 * Time: 09:47
 */
namespace Rimon;
require_once "classes/Rimon.php";
require_once "core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "מי אנחנו");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions();
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

$pageTemplate .=
    <<<Index
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="media/pages/our-team.jpg">
        </div>  
    </div>

    <div class="activists">
        <div class="row">
            <div class="col-sm-12 pull-right">
                <h2>הכירו את הפעילים שלנו!</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-6 col-sm-3" data-aos="fade-up">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Sela">
                        <img src="media/activists/sela.jpg" alt="">
                        <spa class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">אברהם סלה</h3>
                        <span class="post-team">מנכ"ל העמותה</span>
                    </div>
                </div>
            </div>
     
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Shiller">
                        <img src="media/activists/shiller.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">יהונתן שילר</h3>
                        <span class="post-team">ועד מנהל</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Horesh">
                        <img src="media/activists/horesh.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">דוד חורש</h3>
                        <span class="post-team">יושב ראש העמותה</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="fade-down">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Moas">
                        <img src="media/activists/moas.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">דור מואס</h3>
                        <span class="post-team">ראש צוות שיווק פיתוח עסקי</span>
                    </div>
                </div>
            </div>
        </div>
        
            
        <div class="row">
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Nirgi">
                        <img src="media/activists/nirgi.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">ניר גילה</h3>
                        <span class="post-team">ראש צוות פרט וסיוע</span>
                    </div>
                </div>
            </div>
     
            <div class="col-xs-6 col-sm-3" data-aos="fade-up">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Yogev">
                        <img src="media/activists/yogev.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">יוגב אגרנוב</h3>
                        <span class="post-team">ראש צוות מדיה ודיגיטל</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="fade-down">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Yotam">
                        <img src="media/activists/yotam.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">יותר אברהמי</h3>
                        <span class="post-team">ראש צוות פיננסי</span>
                    </div>
                </div>
            </div>
                
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Turgeman">
                        <img src="media/activists/turgi.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">טל תורג'מן</h3>
                        <span class="post-team">ראש צוות אזרחות </span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="fade-down">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Unger">
                        <img src="media/activists/unger.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">עומר אונגר</h3>
                        <span class="post-team">ראש צוות האח הגדול</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="fade-down">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Ohayon">
                        <img src="media/activists/ohayon.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">אברהם אוחיון</h3>
                        <span class="post-team">צוות האח הגדול</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="fade-down">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Lotan">
                        <img src="media/activists/lotan.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">גל לוטן</h3>
                        <span class="post-team">צוות האח הגדול</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Benny">
                        <img src="media/activists/benny.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">בני כץ</h3>
                        <span class="post-team">צוות מדיה ודיגיטל</span>
                    </div>
                </div>
            </div>
            
            </div>
            <div class="row">
            
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Yamin">
                        <img src="media/activists/yamin.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">גיל יאמין</h3>
                        <span class="post-team">צוות אזרחות</span>
                    </div>
                </div>
            </div>
        
            <div class="col-xs-6 col-sm-3" data-aos="fade-up">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Talya">
                        <img src="media/activists/talya.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">טליה זרביב</h3>
                        <span class="post-team">צוות אזרחות</span>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Linoy">
                        <img src="media/activists/linoy.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">לינוי שלמה</h3>
                        <span class="post-team">צוות שיווק ופיתוח עסקי</span>
                    </div>
                </div>
            </div>
        
            
            <div class="col-xs-6 col-sm-3" data-aos="fade-down">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Tick">
                        <img src="media/activists/unknown.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">זכריה טיק</h3>
                        <span class="post-team">צוות פיננסי</span>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-3" data-aos="zoom-in">
                <div class="our-team">
                    <div class="pic" data-toggle="modal" data-target="#modal-Omri">
                        <img src="media/activists/lang.jpg" alt="">
                        <span class="read-more">קרא עוד</span>
                    </div>
                    <div class="team-content">
                        <h3 class="title">עמרי לנג</h3>
                        <span class="post-team">צוות פרט וסיוע</span>
                    </div>
                </div>
            </div>
         
        </div>
        
    </div>
</div>



<!-- Modal Sela-->
<div class="modal fade" id="modal-Sela" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">אברהם סלה - מנכ"ל העמותה</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>אברהם סלה</h2>
                <h4>מנכ"ל העמותה.</h4></p>
                <p>סטודנט לתואר ראשון בהנדסה תעשייה וניהול באוניברסיטת אריאל.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>פלאפון: 052-5644878</h5>
                <h5>management@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/sela2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>


<!-- Modal Shiller-->
<div class="modal fade" id="modal-Shiller" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">יונתן שילר -חבר וועד ומייסד העמותה</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>יונתן שילר</h2>
                <h4>חבר וועד ומייסד העמותה.</h4></p>
                <p>רכז מדריכים ארצי ״במסע ישראלי״.<br>
                   מנחה קבוצות ומדריך ״פנאי אתגרי-טבע תרפיה״. 
                </p>
                <h4>אימייל ליצירת קשר:</h4>
                <h5>management@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/shiller2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Horesh-->
<div class="modal fade" id="modal-Horesh" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">דוד חורש - יו"ר העמותה וממייסדיה</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>דוד חורש</h2>
                <h4>יו"ר העמותה וממייסדיה.</h4></p>
                <p>מייסד ומנכ"ל חברת Toref.<br>
                   פעיל בארגון Startup Grind TLV. 
                </p>
                <h4>אימייל ליצירת קשר:</h4>
                <h5>management@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/horesh2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Moas-->
<div class="modal fade" id="modal-Moas" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">דור מואס - ראש צוות פיתוח עסקי</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>דור מואס</h2>
                <h4>מנהל פיתוח ושיווק עסקי.</h4></p>
                <p>סטודנט להנדסת חשמל ואלקטרוניקה, אונ' ת"א.<br>
                   רכז הכשרות ארצי בתנועת ישראל 2050. 
                </p>
                <h4>אימייל ליצירת קשר:</h4>
                <h5>business-dev@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/moas2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Nirgi-->
<div class="modal fade" id="modal-Nirgi" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ניר גילה - ראש צוות פרט וסיוע</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>ניר גילה</h2>
                <h4>ראש צוות פרט צוות וסיוע.</h4></p>
                <p>סטודנט לחינוך גופני במגמה לאימון בספורט הישגי.<br>
                   מדריך אופניים בחוגים לילדים. 
                </p>
                <h4>אימייל ליצירת קשר:</h4>
                <h5>assistance@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/nirgi2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Yogev-->
<div class="modal fade" id="modal-Yogev" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">יוגב אגרנוב - ראש צוות מדיה ודיגיטל</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>יוגב אגרנוב</h2>
                <h4>ראש צוות מדיה ודיגיטל.</h4></p>
                <p>לומד תוכנה במכללה למנהל.<br>
                   צלם ומדריך, התמחות באומנות דיגיטלית. 
                </p>
                <h4>אימייל ליצירת קשר:</h4>
                <h5>technology@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/yogev2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Yotam-->
<div class="modal fade" id="modal-Yotam" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">יותם אברהמי - ראש צוות פיננסי</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>יותם אברהמי</h2>
                <h4>ראש צוות פיננסי.</h4></p>
                <p>עובד במשרד השיכון אגף אסטרטגיה ומדיניות ברכז מדיניות.<br>
                   מתמחה במשרד הכלכלה באגף לעידוד השקעות זרות בתחום ניתוח כלכלי מתנדב בארגון פעמונים. 
                </p>
                <h4>אימייל ליצירת קשר:</h4>
                <h5>finance@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/yotam2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Yamin-->
<div class="modal fade" id="modal-Yamin" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">גיל יאמין - צוות אזרחות </h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>גיל יאמין</h2>
                <h4>צוות אזרחות.</h4></p>
                <p>מפקד צוות ביחידה לשעבר.<br>
                   לומד הנדסת בניין באוניברסיטת בן גוריון. 
                </p>
                <h4>אימייל ליצירת קשר:</h4>
                <h5>citizens@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/yamin2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Benny-->
<div class="modal fade" id="modal-Benny" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">בני כץ</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>בני כץ</h2>
                <h4>צוות מדיה ודיגיטל.</h4></p>
                <p>סטודנט למדעי המחשב ב-HIT.<br>
                    בוגר הצוות הראשון ביחידה.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>technology@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/benny2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Ohayon-->
<div class="modal fade" id="modal-Ohayon" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">אברהן אוחיון</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>אברהם אוחיון</h2>
                <h4>צוות האח הגדול.</h4></p>
                <p>קרית ארבע.<br>
                    לוחם וראש מדור קרב מגע לשעבר.<br>
                    יזם בתחום הביטחון.<br>
                    מקים ומייסד חברת ריגארד ישראל וריגארד סינגפור.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>bigbrother@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/ohayon2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Linoy-->
<div class="modal fade" id="modal-Linoy" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">לינוי שלמה</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>לינוי שלמה</h2>
                <h4>צוות שיווק ופיתוח עסקי.</h4></p>
                <p>אופטמטריסטית ברשת "רואים שש שש".<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>business-dev@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/linoy2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Talya-->
<div class="modal fade" id="modal-Talya" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">טליה זרביב</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>טליה זרביב</h2>
                <h4>צוות אזרחות.</h4></p>
                <p>פעילת חינוך בזמן השירות הצבאי ביחידה.<br>
                    כיום מאמנת אישית לספורט ואורח חיים בריא לכל הגילאים ומדריכת חדר כושר.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>bigbrother@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/talya2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Turgeman-->
<div class="modal fade" id="modal-Turgeman" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">טל תורג'מן</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>טל תורג'מן</h2>
                <h4>ראש צוות אזרחות.</h4></p>
                <p>לומד פסיכולוגיה לתואר ראשון.<br>
                    עובד כאיש מכירות.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>citizens@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/turgeman2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Lotan-->
<div class="modal fade" id="modal-Lotan" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">גל לוטן</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>גל לוטן</h2>
                <h4>צוות האח הגדול.</h4></p>
                <p>עובד בחברת אל-טל.<br>
                    ירושלמי.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>bigbrother@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/lotan2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Unger-->
<div class="modal fade" id="modal-Unger" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">עומר אונגר</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>עומר אונגר</h2>
                <h4>ראש צוות האח הגדול</h4></p>
                <p>סטודנט לתואר ראשון במשפטים באוניברסיטת בר אילן.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>bigbrother@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/unger2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Omri-->
<div class="modal fade" id="modal-Omri" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">עמרי לנג</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>עמרי לנג</h2>
                <h4>צוות פרט וסיוע</h4></p>
                <p>עובד בתחנת כוח דליה ולומד NLP בתא.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>assistance@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/omri2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Tick-->
<div class="modal fade" id="modal-Tick" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">זכריה טיק</h4>
        </div>
        <div class="modal-body">
        <div class="row">
              <div class="col-sm-6 pull-right">
                <p><h2>זכריה טיק</h2>
                <h4>צוות פיננסי</h4></p>
                <p>סטודנט בבר אילן תואר ראשון בניהול טכנולוגיה.<br>
                </p>
                <h4>דרכים ליצירת קשר:</h4>
                <h5>finance@845.co.il</h5>
                <p></p>
              </div>
              <div class="col-sm-6 pull-left">
                <img src="media/activists/tick2.jpg">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור</button>
        </div>
      </div>
    </div>
</div>
Index;

$pageTemplate .= footerTemplate;
echo $pageTemplate;
