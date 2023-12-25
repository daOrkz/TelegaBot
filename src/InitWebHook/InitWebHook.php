<?php

namespace Bot\InitWebHook;

use Bot\Exceptions\CurlException as CURLException;

class InitWebHook
{
    protected string $ngrokURL;

    public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    protected function generateURL(): string
    {
        return $this->config['apiTelegramUrl'] . $this->config['token'];
    }

    public function init()
    {
        $queryStr = [
          "url" => $this->config['ngrokURL'] . '/index.php',
        ];

        $options = [
          CURLOPT_RETURNTRANSFER => 'true',
          CURLOPT_SSL_VERIFYPEER => 'false',
          CURLOPT_HEADER => 'false',
        ];

        $ch = curl_init($this->generateURL() . "/setWebhook?" . http_build_query($queryStr));
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);

        if (curl_errno($ch)) {
            throw new CURLException(curl_error($ch));
        }

        return json_decode($response);
    }

}
