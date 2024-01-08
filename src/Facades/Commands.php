<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\Facades;

use Bot\TelegramBot\CommandStrategy\Commands\StartCommand;
use Bot\TelegramBot\CommandStrategy\Commands\TimeCommand;
use Bot\TelegramBot\CommandStrategy\Commands\WeatherCurrentCommand;
use Bot\TelegramBot\CommandStrategy\Commands\WeatherForecastCommand;
use Bot\TelegramBot\CommandStrategy\ContextCommand;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;
use Bot\TelegramBot\TelegramBot;
use Bot\Util\InputUser;

/**
 * Description of Commands
 *
 * @author fillipp
 */
class Commands
{
    static function start($data, $config)
    {
        $fromChatId = InputUser::fromChatId($data);

        $contextCommand = new ContextCommand();
        $telegramBot = new TelegramBot($config);

        $contextCommand->setStrategy(new StartCommand($data));

        $helloTextMessage = $contextCommand->executeStrategy();

        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($helloTextMessage)
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    }

    static function time($data, $config)
    {
        $fromChatId = InputUser::fromChatId($data);

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

    static function weather($data, $config)
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

    static function forecast($data, $config)
    {
        $fromChatId = InputUser::fromChatId($data);

        $contextCommand = new ContextCommand();
        $telegramBot = new TelegramBot($config);

        $contextCommand->setStrategy(new WeatherForecastCommand());

        $weathetTextMessage = $contextCommand->executeStrategy();

        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($weathetTextMessage)
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    }

    static function unknown($data, $config)
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
