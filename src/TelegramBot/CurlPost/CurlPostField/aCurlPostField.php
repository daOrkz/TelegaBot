<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CurlPost\CurlPostField;

/**
 * Description of aCurlPostField
 *
 * @author fillipp
 */

class aCurlPostField
{
    protected string $chatId;
    protected string $text;
    protected string $parse_mode;

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

    public function __get($name)
    {
        return $this->$name;
    }
}
