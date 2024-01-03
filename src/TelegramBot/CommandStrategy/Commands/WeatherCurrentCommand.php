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
    protected function getCurrentWeather(): array
    {
        return Weather::getCurrentWeather();
    }
    
    protected function createMessage(array $currentWeather): string
    {
        return "Температура в Мысках: <b>{$currentWeather['current']['temp_c']}</b>" . PHP_EOL
           . "Ощущается как: {$currentWeather['current']['feelslike_c']}" . PHP_EOL
           . "Скорость ветра: {$currentWeather['current']['wind_kph']}";
    }
    
    public function execute(): string
    {
        $currentWeather = $this->getCurrentWeather();
                 
        return $this->createMessage($currentWeather);
        
    }
}

