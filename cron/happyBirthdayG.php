<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 18-Jul-18
 * Time: 13:30
 */
namespace Rimon;
require_once "../classes/Rimon.php";

$time = new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));

$users = Rimon::GetDB()->where("Birthday", "%" . $time->format("m-d") . "%", 'like')->get("users", null, "Id");

foreach ($users as $user) {
    $user = User::GetById($user["Id"]);

    $subject = "מזל טוב {$user->GetFirstName()}";
    $message = <<<Bless
<div style="direction: rtl">
<h2> מזל טוב {$user->GetFirstName()}!!</h2>
<p style="font-size: 20px">היום יום הולדת, היום יום הולדת, היום יום הולדת ל{$user->GetFirstName()}! <br>
משפחת רימון מאחלת לך שההצלחה תלווה אותך לכל מקום
    עם שפע בריאות, שלווה,
    הרבה סיפוק, אושר ושמחה!</p>
    
     <p style="font-size: 16px">אנחנו מזמינים אותך לבקר באתר החדש שלנו: <br>
    <a href="https://845.co.il">למעבר לחץ כאן</a>
    </p>
    
    <p style="font-size: 18px">
        מאחלים,<br>
        משפחת רימון ♥
    </p>
</div>
Bless;

    $user->SendGmail($subject, $message);

    //log
    $logString = "נשלח מייל 'מזל טוב' מתוזמן מחשבון הגימייל (technologyrimon@gmail.com) אל המשתמש {$user->GetFullName()}";
    Rimon::NewLog($logString);
}