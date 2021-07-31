<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 31-Mar-18
 * Time: 18:53
 */
namespace Rimon;
require_once "../classes/Rimon.php";

//log
$ip = $_SERVER["REMOTE_ADDR"];
$logString = "{$ip} קיבל שגיאה 403";
Rimon::NewLog($logString);
?>
<h2>שגיאה 403 - אין באפשרותך לגשת לדף זה</h2>
