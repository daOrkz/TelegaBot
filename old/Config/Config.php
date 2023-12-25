<?php


class Config
{
    protected string $token;
    protected string $apiTelegramUrl;
    protected string $baseURL;
    protected string $chatId;
    protected string $userId;
    protected string $logDir;
    protected string $logFile;
    protected string $logWrite;
    protected string $ngrokURL;


    public function __construct(array $config)
    {
        $this->token = $config['token'];
        $this->apiTelegramUrl = $config['apiTelegramUrl'];
        $this->chatId = $config['chatId'];
        $this->userId = $config['userId'];
        $this->logDir = $config['logDir'];
        $this->logFile = $config['logFile'];
        $this->ngrokURL = $config['ngrokURL'];
        
        $this->logWrite = $this->logDir . $this->logFile;
        $this->baseURL = $this->apiTelegramUrl . $this->token;
    }

    
    public function __get($property)
    {
        return $this->$property;
    }
}
