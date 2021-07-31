<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 31-Mar-18
 * Time: 18:54
 */
namespace Rimon;
require_once "../classes/Rimon.php";

//log
$ip = $_SERVER["REMOTE_ADDR"];
$logString = "{$ip} קיבל שגיאה 500";
Rimon::NewLog($logString);
?>

<h2>שגיאה 500 - שגיאת שרת</h2>

