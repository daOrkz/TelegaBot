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
class WeatherForecastCommand implements iStrategyCommand
{
    public function execute($data): array
    {
        $fromChatId = $data->callback_query->from->id;

        $weathetTextMessage = Weather::getForecastWeather();
        
        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($weathetTextMessage)
            ->build();

        return $sendMessageCurlPostField->getOpt();
    }
}
