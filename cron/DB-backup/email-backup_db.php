<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Apr-18
 * Time: 11:25
 */
namespace Rimon;
require_once "../../classes/Rimon.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


try {
    /** @var \SplFileObject[] $lastBackups */

    $lastBackups = array();
    foreach (Constant::DB_BACKUP_DBS as $dbToBackup) {
        $dir = '/path/to/your/backups' . $dbToBackup . '/';
        foreach (scandir($dir, SCANDIR_SORT_DESCENDING) as $file) {
            $object = new \SplFileObject($dir . $file);
            if ($object->isFile()) {
                $lastBackups[$dbToBackup] = $object;
                break;
            }
        }
    }

    $message = "מצורף במייל גיבוי לכלל בסיסי הנתונים של המערכת כפי שהוגדרו";
    $EmailObject = Rimon::GetEmail("RimonOp - גיבוי לבסיסי הנתונים", $message);

    $EmailObject->addAddress(Constant::WEBMASTER_EMAIL);

    foreach ($lastBackups as $dbToBackup => $fileObject) {
        $EmailObject->addAttachment($fileObject->getRealPath(), $fileObject->getFilename(), "base64", $fileObject->getType());
    }

    if (!$EmailObject->send())
        throw new Exception($EmailObject->ErrorInfo);

    //log
    $logString = "בסיס הנתונים נשלח לאימייל הראשי.";
    Rimon::NewLog($logString);
} catch (\Throwable $e){
    //log
    $logString = "אירע שגיאה בעת שליחת בסיס הנתונים לאיימיל הראשי.";
    Rimon::NewLog($logString);
}