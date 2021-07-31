<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 10-Feb-18
 * Time: 10:25
 */
namespace Rimon;
require_once "../../classes/Rimon.php";

if($_SERVER["HTTP_REFERER"] !== "https://845.co.il/family/calendar/calendar.php")
    die("The access rejected");

if($_POST["Verify"] !== '0') {
    $userInfoDecode = explode("_", base64_decode($_POST["Verify"]));
    $userRole = (Rimon::GetDB()->where("Id", $userInfoDecode[0])->where("RegisterDate", gmdate("Y-m-d H:i:s", (int)$userInfoDecode[1]))->getOne("users", "Role"))["Role"];
} else
    $userRole = '0';

if(isset($_POST["Verify"])) {
    $result = Rimon::GetDB()->where("ShowLevel", $userRole, "<=")->orderBy("Id")->get("events");

    $data = array();
    foreach ($result as $row) {
        $data[] = array(
            'id' => $row["Id"],
            'title' => $row["Title"],
            'start' => $row["StartEvent"],
            'end' => $row["EndEvent"]
        );
    }

    echo json_encode($data);
}