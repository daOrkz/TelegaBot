<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\Facades\Commands;

//use Bot\Facades\iCommandFacade;
//require_once ('../../../src/init.php');


use Bot\TelegramBot\CommandStrategy\Commands\TimeCommand;
use Bot\TelegramBot\CommandStrategy\ContextCommand;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;
use Bot\TelegramBot\TelegramBot;

//$config = \parse_ini_file('../../../config.ini');
/**
 * Description of StartFacade
 *
 * @author fillipp
 */
class Time
{
    static function timeCommand($data, $config)
    {
        $fromChatId = $data->message->from->id;

        $contextCommand = new ContextCommand();
        $telegramBot = new TelegramBot($config);

        $contextCommand->setStrategy(new TimeCommand());

        $timeTextMessage = $contextCommand->executeStrategy();

        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($timeTextMessage)
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    }

}

//StartFacade::startCommand($data, $config);

