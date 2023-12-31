<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CommandStrategy\Commands;

use Bot\TelegramBot\CommandStrategy\iStrategyCommand;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;

use Bot\Services\Weather;

/**
 * Description of StartCommand
 *
 * @author fillipp
 */
class WeatherCurrentCommand implements iStrategyCommand
{
    public function execute($data): array
    {
        $fromChatId = $data->message->from->id;

        $weathetTextMessage = Weather::getCurrentWeather();
                            
        $inlineKeyboard = 
        [ 
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

        return $sendMessageCurlPostField->getOpt();
    }
}
