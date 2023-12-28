<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot;

use Bot\TelegramBot\iTelegramBot;
use Bot\Exceptions\{CommonException, CurlException, TeleBotException};


/**
 * Description of TelegramBot
 *
 * @author fillipp
 */

class TelegramBot implements iTelegramBot
{
    protected array $config;
    protected string $baseUrl;

    public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    protected function setBaseUrl()
    {
        $this->baseUrl = $this->config['apiTelegramUrl'] . $this->config['token'];
        
    }

    public function sendResponseTelegram(string $method, array $postField, $resultJSON = false)
    {
        $this->setBaseUrl();
        
        $options = [
          CURLOPT_URL => "{$this->baseUrl}/{$method}",
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $postField,
          CURLOPT_RETURNTRANSFER => 'true',
          CURLOPT_HTTPHEADER => ["Content-Type:multipart/form-data"],
          CURLOPT_SSL_VERIFYPEER => 'false',
          CURLOPT_HEADER => 'false',
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);
        
        if (curl_errno($ch)) {
            throw new CURLException(curl_error($ch));
        }

        if (isset($response["ok"]) && $response["ok"] == false) {

            $arrResult = json_decode($response, true);
            $arrDataLog = [
              "method" => $method,
              "postField" => $postField,
              "response" => $arrResult
            ];

            $arrDataLogJSON = json_encode($arrDataLog);
            throw new TeleBotException($arrDataLogJSON);
        }

        if ($resultJSON == true) {
            return $response;
        }
        else {
            return json_decode($response, true);
        }
    }
}
