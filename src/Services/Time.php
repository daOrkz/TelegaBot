<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace Bot\Services;

use Bot\Exceptions\CurlException as CURLException;

class Time
{
        
    static function getTime(string $city = 'Asia/Krasnoyarsk'): array
    {
        $baseURL = 'https://www.timeapi.io/api/Time/current/zone?timeZone=';
        
        $url = $baseURL .= $city;
        
        $curl = curl_init($url);
        $options = [
          CURLOPT_RETURNTRANSFER => 'true',
          CURLOPT_SSL_VERIFYPEER => 'false',
          CURLOPT_HEADER => 'false',
        ];

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        
        if (curl_errno($curl)) {
            throw new CURLException(curl_error($curl));
        }
        curl_close($curl);

        return json_decode($response, true);
    }
}
