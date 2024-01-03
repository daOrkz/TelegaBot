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
    protected array $moonPhase = [
        'New Moon' => 'Новолуние',
        'Waxing Crescent' => 'Растущая луна',
        'First Quarter' => 'Первая четверть луны',
        'Waxing Gibbous' => 'Почти полная, возррастающая луна',
        'Full Moon' => 'Полнлуние',
        'Waning Gibbous' => 'Почти полная, убывающая луна',
        'Last Quarter' => 'Последняя четверть луны',
        'Waning Crescen' => 'Месяц',
    ];
    
    protected function getForecastWeather(): array
    {
        return Weather::getForecastWeather();
    }
    
    protected function createMessage(array $forecastWeather): string
    {
        $forecastDays = $forecastWeather['forecast']['forecastday'];

        $weatherTextMessage = '';
        
        foreach ($forecastDays as $forecastDay) {

            $weatherTextMessage .= " -- <b>{$forecastDay['date']}</b> --" . PHP_EOL
            . "Температура от {$forecastDay['day']['maxtemp_c']} до {$forecastDay['day']['mintemp_c']}" . PHP_EOL
            . "Вероятность снега: {$forecastDay['day']['daily_chance_of_snow']}%" . PHP_EOL
            . "Вероятность дождя: {$forecastDay['day']['daily_chance_of_rain']}%" . PHP_EOL
            . "Восход: {$forecastDay['astro']['sunrise']}" . PHP_EOL
            . "Закат: {$forecastDay['astro']['sunset']}" . PHP_EOL
            . "Фаза луны: " . $this->moonPhase[$forecastDay['astro']['moon_phase']] . PHP_EOL
            . "Видимость луны: {$forecastDay['astro']['moon_illumination']}%" . PHP_EOL
            . PHP_EOL;
        }
        
        return $weatherTextMessage;
    }
    
    public function execute($data): array
    {
        $fromChatId = $data->callback_query->from->id;

        $forecastWeather = $this->getForecastWeather();
        
        $weathetTextMessage = $this->createMessage($forecastWeather);
        
        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($weathetTextMessage)
            ->build();

        return $sendMessageCurlPostField->getOpt();
    }
}

