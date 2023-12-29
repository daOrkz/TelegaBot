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
    public function execute($data): array
    {
        $fromChatId = $data->message->from->id;

        $helloTextMessage = "Hello: <b>{$data->message->from->first_name}</b>" . PHP_EOL;
        
        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($fromChatId)
            ->setParse_mode('html')
            ->setText($helloTextMessage)
            ->build();

        return $sendMessageCurlPostField->getOpt();
    }
}
