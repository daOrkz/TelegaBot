<?php

require_once './init.php';
require_once './TelegramBot/TelegramBot.php';
require_once './Vendor/Time/Time.php';
require_once './Vendor/Wether/Wether.php';

$data = json_decode(file_get_contents('php://input'));

$telegramBot = new TelegramBot($config);

/*
$arrayQuery = [
  'chat_id' => $config->userId,
  'text' => $data->message->text,
  'parse_mode' => "html",
  'reply_markup' => json_encode([
    'keyboard' => [
      [
        [
          'text' => 'Время',
          'callback_data' => 'time',
        ],
        [
          'text' => 'Погода',
          'callback_data' => 'wether',
        ],
      ],
    ],
    'resize_keyboard' => true,
  ])
];

$resultQuery = $telegramBot->sendQueryTelegram("sendMessage", $arrayQuery);
*/

$textMessage = mb_strtolower($data->message->text);

switch ($textMessage) {
    case '/time':

        $time = Time::getTime();

        $arrayQuery = [
          'chat_id' => $config->userId,
          'text' => "Московское время: {$time['time']}",
          'parse_mode' => "html",
        ];

        $telegramBot->sendQueryTelegram("sendMessage", $arrayQuery);

        break;
    case '/weather':

        $wether = Wether::getWether();
        
        $arrayQuery = [
          'chat_id' => $config->userId,
          'text' => "Погода в Москве: {$wether}",
          'parse_mode' => "html",
        ];

        $telegramBot->sendQueryTelegram("sendMessage", $arrayQuery);

        break;
    default :
        $arrayQuery = [
          'chat_id' => $config->userId,
          'text' => "Выберите комманду в меню",
          'parse_mode' => "html",
        ];

        $telegramBot->sendQueryTelegram("sendMessage", $arrayQuery);
}
