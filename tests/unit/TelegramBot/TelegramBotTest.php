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

    public function testCurlException()
    {
        $this->expectException(Bot\Exceptions\CurlException::class);
        $bot = new TelegramBot(['apiTelegramUrl' => '', 'token' => '']);
        $bot->sendResponseTelegram('method', []);
    }

    public function testTeleBotException()
    {
        $this->expectException(Bot\Exceptions\TeleBotException::class);
        $bot = new TelegramBot(['apiTelegramUrl' => 'https://api.telegram.org/bot', 'token' => '5555']);
        $bot->sendResponseTelegram('method', []);
    }

//    public function test_sendResponseTelegram_return_Array()
//    {
//        $bot = new TelegramBot(['apiTelegramUrl' => 'https://api.telegram.org/bot', 'token' => '5555']);
//
//        $data = json_decode($bot->sendResponseTelegram('sendMessage', []), true);
//
//        $this->assertArrayHasKey('response', $data);
//    }

}
