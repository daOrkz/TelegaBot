<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\Facades\Commands;

use Bot\TelegramBot\CommandStrategy\Commands\WeatherCurrentCommand;
use Bot\TelegramBot\CommandStrategy\ContextCommand;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;
use Bot\TelegramBot\TelegramBot;
use Bot\Util\InputUser;

/**
 * Description of StartFacade
 *
 * @author fillipp
 */
class Weather
{
    static function weatherCommand($data, $config)
    {
        $fromChatId = InputUser::fromChatId($data);


        $contextCommand = new ContextCommand();
        $telegramBot = new TelegramBot($config);

        $contextCommand->setStrategy(new WeatherCurrentCommand());

        $weathetTextMessage = $contextCommand->executeStrategy();

        $inlineKeyboard = [
            [
                'text' => 'Прогноз на 3 дня',
                'callback_data' => 'forecast',
            ]
        ];

        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($weathetTextMessage)
            ->setReplyMarkup('inline_keyboard', $inlineKeyboard)
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    }

}

//StartFacade::startCommand($data, $config);

