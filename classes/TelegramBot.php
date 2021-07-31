<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 29-Mar-18
 * Time: 17:45
 */
namespace Rimon;


class TelegramBot
{
    const botName = "";
    const botApi = "";
    const telegramUrl = "https://api.telegram.org/bot";
    const rimonChannelId = "";

    public static function SendMessage($to, $message) {
        $request_params = [
            'chat_id' => $to,
            'text' => $message
        ];
        $request_url = self::telegramUrl . self::botApi . "/sendMessage?" . http_build_query($request_params);
        $ch = curl_init($request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);

        //log
        $botName = self::botName;
        $chatId = self::rimonChannelId;
        $logString = "הבוט $botName שלח הודעה לשיחה מספר $chatId";
        Rimon::NewLog($logString);
    }












}