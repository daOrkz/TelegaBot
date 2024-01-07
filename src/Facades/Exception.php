<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\Facades;

use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldAdminBuilder;
use Bot\TelegramBot\TelegramBot;

/**
 * Description of Exception
 *
 * @author fillipp
 */
class Exception
{
    static function handling($e, $config)
    {
        $telegramBot = new TelegramBot($config);

        $sendMessageCurlPostFieldAdmin = (new CurlPostFieldAdminBuilder())
            ->init()
            ->setChatId($config['adminId'])
            ->setParse_mode('html')
            ->build();

        $sendMessageCurlPostFieldAdmin->setMessage($e->sendErrorMessage());

        $curlOpt = $sendMessageCurlPostFieldAdmin->getOpt();
        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    }

}
