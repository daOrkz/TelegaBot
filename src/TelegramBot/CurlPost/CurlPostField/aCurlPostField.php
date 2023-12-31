<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CurlPost\CurlPostField;

use Bot\Exceptions\CommonException;

/**
 * Description of aCurlPostField
 *
 * @author fillipp
 */
abstract class aCurlPostField
{
    protected string $chatId;
    protected string $text;
    protected string $parse_mode;
    protected $replyMarkup = null;
    
    abstract public function getOpt(): array;

    public function setChatId(string $chatId): void
    {
        $this->chatId = $chatId;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setParse_mode(string $parse_mode): void
    {
        $this->parse_mode = $parse_mode;
    }

    public function setReplyMarkup(string $typeKeyBoard, array $keyBoard)
    {           
        if($typeKeyBoard != 'inline_keyboard' && $typeKeyBoard != 'keyboard') {
            throw new CommonException('Bad type keyboard');
        }
        
        $this->replyMarkup = json_encode([
            $typeKeyBoard => [$keyBoard]
        ]);
    }

    public function __get($name)
    {
        return $this->$name;
    }

}
