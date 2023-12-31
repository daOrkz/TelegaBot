<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CurlPost\CurlPostField;

use Bot\TelegramBot\CurlPost\CurlPostField\aCurlPostField;


/**
 * Description of CurlPostFieldHtml
 *
 * @author fillipp
 */

class CurlPostFieldAdmin extends aCurlPostField
{
    public function getOpt(): array
    {
        return [
          'chat_id' => $this->chatId,
          'text' => $this->text,
          'parse_mode' => $this->parse_mode,
        ];
    }
    
        
    public function setMessage(string $message): void
    {
        $this->text = $message;
    }
}
