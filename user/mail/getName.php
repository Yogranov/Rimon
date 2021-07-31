<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 25-Feb-18
 * Time: 22:00
 */
namespace Rimon;
require_once "../../classes/Rimon.php";

if($_SERVER["HTTP_REFERER"] !== "https://845.co.il/user/mail/new-conversation.php")
    die("The access rejected");

if(isset($_POST["term"])) {
    //$sql = Rimon::GetDB()->where("FirstName", "%" . $_POST["term"] . "%", 'like')->orWhere("LastName", "%" . $_POST["term"] . "%", 'like')->get("users", 5, array("Id", "FirstName", "LastName"));
    $sql = Rimon::GetDB()->query("SELECT FirstName,LastName,Id FROM users WHERE CONCAT(FirstName,' ',LastName) like '%" . Rimon::GetDB()->escape($_POST["term"]) . "%';");
    $arrayToSend = array();
    foreach ($sql as $data) {
        $arrayToSend[] = array(
            'label' => $data["FirstName"] . " " . $data["LastName"],
            'value' => $data["Id"]
        );
    }
    echo json_encode($arrayToSend);
}
