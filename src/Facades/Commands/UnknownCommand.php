<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\Facades\Commands;

use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;
use Bot\TelegramBot\TelegramBot;
use Bot\Util\InputUser;

class UnknownCommand
{
    static function unknownCommand($data, $config)
    {
        $fromChatId = InputUser::fromChatId($data);

        $telegramBot = new TelegramBot($config);

        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText(
                "Неизвестная команда." . PHP_EOL
                . "Выберите команду из списка в меню.")
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    }

}

//StartFacade::startCommand($data, $config);

