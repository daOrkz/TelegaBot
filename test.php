<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'src/init.php';

use Bot\Util\Logger as Logger;

$ErrLogger = new Logger('/Logs', '/errLogs.txt');
$logger = new Logger();

class Weather
{
    static string $currentWeatherUrl = 'https://weatherapi-com.p.rapidapi.com/current.json?q=53.45154224%2C87.38461796';
    static string $forecasttWeatherUrl = 'https://weatherapi-com.p.rapidapi.com/forecast.json?q=53.45154224%2C87.38461796&days=3';
    
    static array $curlOpt = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: weatherapi-com.p.rapidapi.com",
            "X-RapidAPI-Key: 54e1575496msh4b881834862ec00p1160f5jsn5e68d631b210"
        ],
    ];
    static array $moonPhase = [
        'New Moon' => 'Новолуние',
        'Waxing Crescent' => 'Растущая луна',
        'First Quarter' => 'Первая четверть луны',
        'Waxing Gibbous' => 'Почти полная, возррастающая луна',
        'Full Moon' => 'Полнлуние',
        'Waning Gibbous' => 'Почти полная, убывающая луна',
        'Last Quarter' => 'Последняя четверть луны',
        'Waning Crescen' => 'Месяц',
    ];

    static function getCurrentWeather(): string
    {

        $curl = curl_init(self::$currentWeatherUrl);

        curl_setopt_array($curl, self::$curlOpt);

        $response = curl_exec($curl);

        curl_close($curl);

        if (curl_errno($curl)) {
            throw new CURLException(curl_error($curl));
        }

        $currentWeather = json_decode($response, true);
        
        $weathetTextMessage = "Температура в Мысках: <b>{$currentWeather['current']['temp_c']}</b>" . PHP_EOL
           . "Ощущается как: {$currentWeather['current']['feelslike_c']}" . PHP_EOL
           . "Скорость ветра: {$currentWeather['current']['wind_kph']}";
           
       return $weathetTextMessage;
    }

    static function getForecastWeather(): string
    {

        $curl = curl_init(self::$forecasttWeatherUrl);


        curl_setopt_array($curl, self::$curlOpt);

        $response = curl_exec($curl);

        curl_close($curl);

        if (curl_errno($curl)) {
            throw new CURLException(curl_error($curl));
        }

        $weather = json_decode($response, true);
        
        $forecastDays = $weather['forecast']['forecastday'];

        $weathetTextMessage = '';
        
        foreach ($forecastDays as $forecastDay) {

            $weathetTextMessage .= " -- <b>{$forecastDay['date']}</b> -- <br>"
            . "Температура от {$forecastDay['day']['maxtemp_c']} до {$forecastDay['day']['mintemp_c']} <br>"
            . "Вероятность снега: {$forecastDay['day']['daily_chance_of_snow']}% <br>"
            . "Вероятность дождя: {$forecastDay['day']['daily_chance_of_rain']}% <br>"
            . "Восход: {$forecastDay['astro']['sunrise']} <br>"
            . "Закат: {$forecastDay['astro']['sunset']} <br>"
            . "Фаза луны: " . self::$moonPhase[$forecastDay['astro']['moon_phase']] . "<br>"
            . "Видимость луны: {$forecastDay['astro']['moon_illumination']}% <br>"
            . '<br>';
        }
        
        return $weathetTextMessage;
    }

}


echo Weather::getForecastWeather();


exit();

$weather = Weather::getForecastWeather();
$forecastDays = $weather['forecast']['forecastday'];

$moonPhase = [
    'New Moon' => 'Новолуние',
    'Waxing Crescent' => 'Растущая луна',
    'First Quarter' => 'Первая четверть луны',
    'Waxing Gibbous' => 'Почти полная, возррастающая луна',
    'Full Moon' => 'Полнлуние',
    'Waning Gibbous' => 'Почти полная, убывающая луна',
    'Last Quarter' => 'Последняя четверть луны',
    'Waning Crescen' => 'Месяц',
];

foreach ($forecastDays as $forecastDay) {
    echo '<pre>';
//    print_r($forecastDay);
//    print_r($forecastDay['date']);
//    print_r($forecastDay['day']);
//    print_r($forecastDay['astro']);
    echo '</pre>';
    echo "{$forecastDay['date']} <br>"
    . "Температура от {$forecastDay['day']['maxtemp_c']} до {$forecastDay['day']['mintemp_c']} <br>"
    . "Вероятность снега: {$forecastDay['day']['daily_chance_of_snow']}% <br>"
    . "Вероятность дождя: {$forecastDay['day']['daily_chance_of_rain']}% <br>"
    . "Восход: {$forecastDay['astro']['sunrise']} <br>"
    . "Закат: {$forecastDay['astro']['sunset']} <br>"
    . "Фаза луны: " . $moonPhase[$forecastDay['astro']['moon_phase']] . '<br>'
    . "Видимость луны: {$forecastDay['astro']['moon_illumination']} <br>"
    ;
}