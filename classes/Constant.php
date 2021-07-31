<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 14-Oct-17
 * Time: 17:53
 */

namespace Rimon;

class Constant
{
    const SYSTEM_TEST_OR_EMPTY = "";
    const SYSTEM_NAME = "rimon".self::SYSTEM_TEST_OR_EMPTY ;
    const SYSTEM_TIMEZONE = "Asia/Jerusalem";
    const SYSTEM_DOMAIN = "https://845.co.il/";
    const SYSTEM_LOCAL_ABSOLUTE_PATH = "/path/to/folder";
    const SYSTEM_WEBHOST_ROOT_DIRECTORY = "/path/to/folder/";
    const WEBMASTER_EMAIL = "example@example.com";
    const MAIN_GMAIL = "example@example.com";
    const SEO_EMAIL = "example@example.com";
    const DB_BACKUP_FILES = 14;
    const DB_BACKUP_COMPRESSION = "";

    const DB_BACKUP_DBS = array(
        self::MYSQL_DATABASE
    );

    const EMAIL_MAIN_NAME = "עמותת בוגרי רימון";
    const EMAIL_MAIN_ADDRESS = "example@example.co.il";

    //Mysql
    const MYSQL_SERVER = "";
    const MYSQL_PROTOCOL = "";
    const MYSQL_SERVER_PORT = 0;
    const MYSQL_DATABASE = "";

    //New user - confirm email
    const CONFIRM_MASTER_ID = 123456789;

    //Jobs icons
    const JOBS_ICONS = array(
        1 => "https://845.co.il/media/icons/jobs/explanation.png",
        2 => "https://845.co.il/media/icons/jobs/office.png",
        3 => "https://845.co.il/media/icons/jobs/weapon.png",
        4 => "https://845.co.il/media/icons/jobs/money_bag.png",
        5 => "https://845.co.il/media/icons/jobs/teach.png",
        6 => "https://845.co.il/media/icons/jobs/drive.png",
        7 => "https://845.co.il/media/icons/jobs/manage.png",
        8 => "https://845.co.il/media/icons/jobs/magen.png",
        9 => "https://845.co.il/media/icons/jobs/other.png",
        "default" => array("", "")
    );

    //Google reCAPCHA
    const GOOGLE_RECAPTCHA_SECRET_KEY = "";

    //Google Analytics
    const GOOGLE_ANALYTICS_ACTIVE = true;
    const GOOGLE_ANALYTICS_CODE = "
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-86571627-2\"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-86571627-2');
        </script>
    ";
}