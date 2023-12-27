<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CurlPost\CurlPostFieldBuilder;

/**
 * Description of iCurlPostFieldBiulder
 *
 * @author fillipp
 */
interface iCurlPostFieldBuilder
{
    public function setChatId(string $chatId): iCurlPostFieldBuilder;
    public function setText(string $text): iCurlPostFieldBuilder;
    public function setParse_mode(string $parse_mode): iCurlPostFieldBuilder;
    public function build();
}
