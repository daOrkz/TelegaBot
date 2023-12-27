<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CurlPost\CurlPostFieldBuilder;

use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\iCurlPostFieldBuilder;
use Bot\TelegramBot\CurlPost\CurlPostField\CurlPostFieldMd;

/**
 * Description of CurlPostFieldMdBuilder
 *
 * @author fillipp
 */
class CurlPostFieldMdBuilder implements iCurlPostFieldBuilder
{
    protected CurlPostFieldMd $message;

    public function init()
    {
        $this->message = new CurlPostFieldMd();
        return $this;
    }

    public function setChatId(string $chatId): iCurlPostFieldBuilder
    {
        $this->message->setChatId($chatId);
        return $this;
    }

    public function setParse_mode(string $parse_mode): iCurlPostFieldBuilder
    {
        $this->message->setParse_mode($parse_mode);
        return $this;
    }

    public function setText(string $text): iCurlPostFieldBuilder
    {
        $this->message->setText($text);
        return $this;
    }

    public function build()
    {
        return $this->message;
    }

}
