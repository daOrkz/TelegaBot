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
    
    protected function setBaseUrl(): void
    {
        $this->baseUrl = $this->config['apiTelegramUrl'] . $this->config['token'];
        
    }

    public function sendResponseTelegram(string $method, array $postField, $resultJSON = false): array
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

        $response = json_decode(curl_exec($ch), true);
        
        if (curl_errno($ch)) {
            throw new CURLException(curl_error($ch));
        }
        
        curl_close($ch);

        if (empty($response['ok'])) {

            $arrDataLog = [
              "method" => $method,
//              "postField" => $postField,
              "response" => $response
            ];

            $arrDataLogJSON = json_encode($arrDataLog, JSON_UNESCAPED_UNICODE);
            throw new TeleBotException($arrDataLogJSON);
        }

        return json_decode($response, true);
    }
}
