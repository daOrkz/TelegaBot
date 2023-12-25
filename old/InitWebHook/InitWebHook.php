<?php


class InitWebHook
{
    protected Config $config;
    
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    public function init()
    {
      $queryStr = [
        "url" => $this->config->ngrokURL . '/index.php',
      ];
      
      $options = [
        CURLOPT_RETURNTRANSFER =>  'true',
        CURLOPT_SSL_VERIFYPEER => 'false',
        CURLOPT_HEADER => 'false',
      ];  
      
      $ch = curl_init($this->config->baseURL . "/setWebhook?" . http_build_query($queryStr));
      curl_setopt_array($ch, $options);
      
      $response = curl_exec($ch);
      curl_close($ch);
      
      return $response;
    }
}
