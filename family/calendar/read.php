<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 10-Feb-18
 * Time: 11:35
 */
namespace Rimon;
require_once "../../classes/Rimon.php";

if($_SERVER["HTTP_REFERER"] !== "https://845.co.il/family/calendar/calendar.php")
    die("The access rejected");

if(isset($_POST["id"])) {
    $info = (Rimon::GetDB()->where("Id", Rimon::GetDB()->escape($_POST['id']))->getOne("events"))["Id"];
    $eventObj = Event::GetById($info);
    $data["verify"] = base64_encode($eventObj->GetId() . "_" . $eventObj->GetOpenDate()->format("U"));
    echo json_encode($data);
}

