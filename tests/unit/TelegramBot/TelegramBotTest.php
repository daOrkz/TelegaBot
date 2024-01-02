<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
/**
 * Description of TelegramBot
 *
 * @author fillipp
 */

use Bot\TelegramBot\TelegramBot;

/**
 * @covers Bot\TelegramBot\TelegramBot
 * 
 */
class TelegramBotTest extends PHPUnit\Framework\TestCase
{
    private $bot;
    
    protected function setUp(): void
    {
        $this->bot = new TelegramBot([]);
    }
    
//    public function testSet_Base_Url(): void
//    {
//        $bot = new TelegramBot(['apiTelegramUrl' => 'string', 'token' => 'string']);
//
//    }
    
    public function testException()
    {
        $this->expectException(Bot\Exceptions\CurlException::class);
        $initWebHook = new TelegramBot(['apiTelegramUrl' => '', 'token' => '']);
        $initWebHook->sendResponseTelegram('method', []);
    }
}
