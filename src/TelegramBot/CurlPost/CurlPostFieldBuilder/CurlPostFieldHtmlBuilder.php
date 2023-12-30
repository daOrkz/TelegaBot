<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CurlPost\CurlPostFieldBuilder;

use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\iCurlPostFieldBuilder;
use Bot\TelegramBot\CurlPost\CurlPostField\CurlPostFieldHtml;


/**
 * Description of CurlPostFieldHtmlBuilder
 *
 * @author fillipp
 */
class CurlPostFieldHtmlBuilder implements iCurlPostFieldBuilder
{
    protected CurlPostFieldHtml $curlPostField;
    
    public function init()
    {
        $this->curlPostField = new CurlPostFieldHtml();
        return $this;
    }

    public function setChatId(string $chatId): iCurlPostFieldBuilder
    {
        $this->curlPostField->setChatId($chatId);
        return $this;
    }

    public function setParse_mode(string $parse_mode): iCurlPostFieldBuilder
    {
        $this->curlPostField->setParse_mode($parse_mode);
        return $this;
    }

    public function setText(string $text): iCurlPostFieldBuilder
    {
        $this->curlPostField->setText($text);
        return $this;
    }
    
    public function setReplyMarkup(string $typeKeyBoard, array $keyBoard): iCurlPostFieldBuilder
    {
        $this->curlPostField->setReplyMarkup($typeKeyBoard, $keyBoard);
        return $this;
    }

    public function build()
    {
//        echo get_parent_class($this->curlPostField) ;
        return $this->curlPostField;
    }
}
