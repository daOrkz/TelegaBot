<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CommandStrategy\Commands;

use Bot\TelegramBot\CommandStrategy\iStrategyCommand;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;

use Bot\Services\Time;

/**
 * Description of StartCommand
 *
 * @author fillipp
 */
class TimeCommand implements iStrategyCommand
{
    
    protected function getTime(): array
    {
        return Time::getTime();
    }
    
    protected function createMessage(array $currentTime): string
    {
        return "Текущее время: <b>{$currentTime['time']}</b>" . PHP_EOL;
    }
    
    public function execute(): string
    {
        $currentTime = $this->getTime();
        
        return $this->createMessage($currentTime);
        
    }
}
