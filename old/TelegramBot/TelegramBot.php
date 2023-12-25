<?php

class TelegramBot
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function sendQueryTelegram($method, $arrayQuery = "", $resultJSON = false)
    {
        $ch = curl_init();
        $options = [
          CURLOPT_URL => "{$this->config->baseURL}/{$method}",
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $arrayQuery,
          CURLOPT_RETURNTRANSFER => 'true',
          CURLOPT_HTTPHEADER => ["Content-Type:multipart/form-data"],
          CURLOPT_SSL_VERIFYPEER => 'false',
          CURLOPT_HEADER => 'false',
        ];

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);

        if (!isset($response)) {
            throw new Exception(curl_error($ch));
        }

        if (isset($data["ok"]) && $data["ok"] == false) {

            $arrResult = json_decode($result, true);
            $arrDataLog = [
              "method" => $method,
              "arrayQuery" => $arrayQuery,
              "arrResult" => $arrResult
            ];

            $arrDataLogJSON = json_encode($arrDataLog);
            throw new Exception($arrDataLogJSON);
        }

        if ($resultJSON == true) {
            return $response;
        }
        else {
            return json_decode($response, true);
        }
    }
    

}
