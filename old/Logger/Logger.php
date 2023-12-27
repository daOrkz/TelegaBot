<?php

class Logger
{
    protected string $directory = __DIR__ . '/../';
    protected string $fileName;

    public function __construct(string $directory, string $fileName)
    {
        $this->directory .= $directory;
        $this->fileName = $fileName;
    }

    public function writeLog($text, bool $append = false)
    {
        if (!file_exists($this->directory)) {
            mkdir($this->directory, 0777, true);
        }

        $date = date("d-m-Y H:i:s");
        
        
        if($append){
            file_put_contents($this->directory . $this->fileName, $date." ".print_r($text, true)."\r\n", FILE_APPEND);
        } else {
            file_put_contents($this->directory . $this->fileName, $date." ".print_r($text, true)."\r\n");
        }
        
    }

    static function consoleLog($text)
    {
        echo PHP_EOL;
        print_r($text);
        echo PHP_EOL;
    }
    
}
