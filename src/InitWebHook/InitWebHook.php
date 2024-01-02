<?php

namespace Bot\InitWebHook;

use Bot\Exceptions\CurlException as CURLException;

class InitWebHook
{
    protected string $Url;
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->Url = $this->config['apiTelegramUrl'] . $this->config['token'];
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

        if (curl_errno($ch)) {
            throw new CURLException(curl_error($ch));
        }
        curl_close($ch);

        return json_decode($response, true);
    }
    
    public function __get($name)
    {
        return $this->$name;
    }

}
