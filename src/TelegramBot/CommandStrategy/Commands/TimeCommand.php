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
    public function execute($data): array
    {
        $fromChatId = $data->message->from->id;

        $curretnTime = Time::getTime();
        
        $timeTextMessage = "Текущее время: <b>{$curretnTime['time']}</b>" . PHP_EOL;
        
        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($timeTextMessage)
            ->build();

        return $sendMessageCurlPostField->getOpt();
    }
}
