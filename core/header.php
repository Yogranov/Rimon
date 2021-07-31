<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 30-Dec-17
 * Time: 22:06
 */
namespace Rimon;
require_once "manageMenus.php";
require_once "globals.php";

session_start();

const headerTemplate = <<<Header
<!DOCTYPE html>
<html lang="heb">
<head>
    <title>{PageTitle}</title>
    <link rel="icon" href="https://845.co.il/media/favicon.png">
    <meta name="viewport" content="width=device-width" charset="UTF-8">
    

        <!-- jquery Core -->
    <link rel="stylesheet" href="https://845.co.il/css/jquery-ui.css">
    <script src="https://845.co.il/js/jquery-3.2.1.min.js"></script>
    <script src="https://845.co.il/js/jquery-ui.min.js"></script>
    
        <!-- BootStrap 3 -->
    <link rel="stylesheet" href="https://845.co.il/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://845.co.il/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://845.co.il/js/bootstrap.min.js"></script>
    
    
        <!--   AOS animations   -->
    <link href="https://845.co.il/css/aos.css" rel="stylesheet">
    <script src="https://845.co.il/js/aos.js"></script>
    
    
      <!--My Styles -->
    <link rel="stylesheet" type="text/css" href="https://845.co.il/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://845.co.il/css/tables.css">

    <link rel="stylesheet" type="text/css" href="https://845.co.il/css/mainSlider.css">

    <!-- Gallerys files -->
    <script type='text/javascript' src='https://845.co.il/media/unitegallery/js/unitegallery.min.js'></script>	
	<link rel='stylesheet' href='https://845.co.il/media/unitegallery/css/unite-gallery.css' type='text/css'/>
    
        <!--site main js-->
    <script src="https://845.co.il/js/jqueryMain.js"></script>
    <script src="https://845.co.il/js/main.js"></script>

        <!--TINYMCE EDITOR -->
    <script type="text/javascript" src="https://845.co.il/core/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="https://845.co.il/core/tinymce/init-tinymce.js"></script>
    
    <!-- Google reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
Header;
//TODO: replace all url!!!!

const bodyTemplate = <<<NavBar
<body>
<div class="container main">

<nav class="navbar navbar-default">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <span class="navbar-responsive-title"> <img src="https://845.co.il/media/logo.png" alt="logo"></span>
    <img class="logo" src="https://845.co.il/media/logo.png" alt="logo">
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
                <li><a href="https://845.co.il/contact-us.php">צור קשר<i class="glyphicon glyphicon"></i></a></li>
                <li><a href="https://845.co.il/donate.php">תרומה לעמותה<i class="glyphicon glyphicon"></i></a></li>
                <li><a href="https://845.co.il/newsletter.php">ניוזלטר<i class="glyphicon glyphicon"></i></a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon"></i>גלריות<i class="glyphicon glyphicon-menu-down"></i></a>
                  <ul class="dropdown-menu"  style="text-align: center">
                        <li><a href="https://845.co.il/gallerys/unit.php">היחידה</a></li>
                        <li><a href="https://845.co.il/gallerys/association.php">העמותה</a></li>
                  </ul>
                </li>
                <li><a href="https://845.co.il/projects.php">פרויקטים<i class="glyphicon glyphicon"></i></a></li>
                <li><a href="https://845.co.il/theunit.php">היחידה <i class="glyphicon glyphicon"></i></a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon"></i>העמותה<i class="glyphicon glyphicon-menu-down"></i></a>
                  <ul class="dropdown-menu"  style="text-align: center">
                        <li><a href="https://845.co.il/teams.php">צוותי העמותה</a></li>
                        <li><a href="https://845.co.il/meet-us.php">פעילי העמותה</a></li>
                  </ul>
                </li>
                <li><a href="https://845.co.il/index.php">דף הבית <i class="glyphicon glyphicon"></i></a></li>
                
                <!-- Friends Menu-->
                    {Menu}
      </ul>
    </div>
  </div>
</nav>


NavBar;

const officialMenu = <<< OfficialMenu
                <li>
                     <li class="dropdown">
                        <button style="margin-top: 8px" class="dropdown-toggle btn btn-default" data-toggle="dropdown">כניסת חבר</button>
                        <ul class="dropdown-menu" style="padding: 15px; min-width: 250px; text-align: right">
                           <li>
                              <div class="row">
                                 <div class="col-md-12">
                                    <form class="form" role="form" method="POST" action="https://845.co.il/login.php" accept-charset="UTF-8" id="login-nav">
                                       <div class="form-group">
                                          <label class="sr-only" for="header-login-form-id">ת"ז</label>
                                          <input type="text" name="header-login-form-id" class="form-control" id="header-login-form-id" placeholder="תעודת זהות" required>
                                       </div>
                                       <div class="form-group">
                                          <label class="sr-only" for="header-login-form-password">סיסמה</label>
                                          <input type="password" name="header-login-form-password" class="form-control" id="header-login-form-password" placeholder="סיסמה" required>
                                       </div>
                                       <div class="checkbox" style="direction: ltr">
                                       <div style="margin: 4% auto;" class="g-recaptcha" data-sitekey="6LceIVAUAAAAABYbgsFsc1M3xaAqNF8dKyFK8uDE"></div>
                                          <label>
                                          <input name="header-login-form-remember-me" type="checkbox"> <b>זכור אותי</b>
                                          </label>
                                       </div>
                                       <div class="form-group" style="margin: 0">
                                          <button style="color: white" name="header-login-form-login" type="submit" class="btn btn-success btn-block">התחבר</button>
                                          <a href="https://845.co.il/forgot-password.php" target="_blank" style="text-align: center; font-size: 14px">שכחתי סיסמה</a>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </li>
                           <li class="divider"></li>
                           <li>
                              <a style="padding: 0" href="https://845.co.il/register.php"><button class="btn btn-primary btn-block">הרשמה</button></a>
                           </li>
                        </ul>
                     </li>
               </li>
OfficialMenu;

const familyMenu = <<< FamilyMenu
                <li>
                     <li class="dropdown">
                        <button style="margin-top: 8px" class="dropdown-toggle btn btn-default" data-toggle="dropdown">תפריט חבר</button>
                        <ul class="dropdown-menu multi-level" style="padding: 15px; min-width: 250px; text-align: right">
                              <li><a href="https://845.co.il/family/main.php">דף משפחה</a></li>  
                              <li><a href="https://845.co.il/family/benefits.php">הטבות מיוחדות</a></li>  
                              <li><a href="https://845.co.il/family/jobs/jobsboard.php">לוח דרושים</a></li>
                              <li><a href="https://845.co.il/family/sign.php">אישור חברות</a></li>  
                              <li><a href="https://845.co.il/family/message-board/board.php">לוח מודעות</a></li>
                              <li><a href="https://845.co.il/family/calendar/calendar.php">לוח אירועים</a></li>  
                              <li class="divider"></li>
                              
                                {manageMenu}
                              
                              <li style="margin-bottom: 5px"><a style="padding: 0" href="https://845.co.il/user/profile.php"><button class="btn btn-success btn-block">פרופיל אישי</button></a></li>
                              <li><a style="padding: 0" href="https://845.co.il/logout.php"><button class="btn btn-danger btn-block">יציאה &#9785;</button></a></li>
                        </ul>
                     </li>
               </li>
FamilyMenu;



const footerTemplate = <<<Footer

</body>
<footer>
        <div class="container footer"> ~כל הזכויות שמורות - עמותת בוגרי רימון 2018~ </div>
</footer>
</html>
Footer;


