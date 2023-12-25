<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


class Time
{
    
    
    static function getTime(string $city = 'Europe/Moscow')
    {
        $baseURL = 'https://www.timeapi.io/api/Time/current/zone?timeZone=';
        
        $url = $baseURL .= $city;
        
        $ch = curl_init($url);
        $options = [
          CURLOPT_RETURNTRANSFER => 'true',
          CURLOPT_SSL_VERIFYPEER => 'false',
          CURLOPT_HEADER => 'false',
        ];

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);
        
        $time = json_decode($response, true);
        
        return $time;
    }
}


echo Time::getTime();