<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CurlPost\CurlPostField;

use Bot\TelegramBot\CurlPost\aCurlPostField;

/**
 * Description of CurlPostFieldHtml
 *
 * @author fillipp
 */
class CurlPostFieldMd extends aCurlPostField
{
    public function __serialize(): array
    {
        return [
          'chatId' => $this->chatId,
          'text' => $this->text,
          'parse_mode' => $this->parse_mode,
        ];
    }
}
