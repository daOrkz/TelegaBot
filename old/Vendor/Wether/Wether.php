<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
/**
 * Description of Wether
 *
 * @author fillipp
 */
class Wether
{
    static function getWether(string $city = 'Moscow')
    {
//        $baseURL = 'api.openweathermap.org/data/2.5/weather?q=Moscow&APPID=3e693891d250e47d9dc865152b53df36&lang=ru&units=metric&mode=html';
        
        $url = "api.openweathermap.org/data/2.5/weather?q={$city}&APPID=3e693891d250e47d9dc865152b53df36&lang=ru&units=metric";
        
        $ch = curl_init($url);
        $options = [
          CURLOPT_RETURNTRANSFER => 'true',
          CURLOPT_SSL_VERIFYPEER => 'false',
          CURLOPT_HEADER => 'false',
        ];

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);
        
        
        $wether = json_decode($response, true);
        
        $description = $wether["weather"][0]['description'];
        $temp = $wether["main"]['temp'];
        
        return "$description \n"
            . "$temp";
    }
}


//print_r(Wether::getWether());