<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
namespace Bot\Services;

use Bot\Exceptions\CurlException as CURLException;


/**
 * Description of Weather
 * @param current or
 *
 * @author fillipp
 */
class Weather
{
    static function getWeather(string $param): array
    {
        $options = [
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

        if ($param == 'current') {
            $curl = curl_init("https://weatherapi-com.p.rapidapi.com/current.json?q=53.45154224%2C87.38461796");
        }
        else {
            $curl = curl_init("https://weatherapi-com.p.rapidapi.com/forecast.json?q=53.45154224%2C87.38461796&days=3");
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        curl_close($curl);

        if (curl_errno($curl)) {
            throw new CURLException(curl_error($curl));
        }

        return json_decode($response, true);
    }

}
