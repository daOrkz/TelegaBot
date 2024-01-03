<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CommandStrategy\Commands;

use Bot\TelegramBot\CommandStrategy\iStrategyCommand;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;


/**
 * Description of StartCommand
 *
 * @author fillipp
 */
class StartCommand implements iStrategyCommand
{
    protected $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    protected function createMessage(): string
    {
        return "Hello: <b>{$this->data->message->from->first_name}</b>" . PHP_EOL;
    }
    
    public function execute(): string
    {
        
        return $this->createMessage();
        
    }
}
