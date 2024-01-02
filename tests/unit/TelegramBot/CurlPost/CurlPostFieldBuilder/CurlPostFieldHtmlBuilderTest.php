<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of CurlPostFieldHtmlBuilderTest
 *
 * @author fillipp
 */
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldAdminBuilder;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldMdBuilder;

/**
 * @covers Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder
 * @covers Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldAdminBuilder
 * @covers Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldMdBuilder
 * @covers Bot\TelegramBot\CurlPost\CurlPostField\CurlPostFieldHtml
 * @covers Bot\TelegramBot\CurlPost\CurlPostField\CurlPostFieldMd
 * @covers Bot\TelegramBot\CurlPost\CurlPostField\CurlPostFieldAdmin
 * @covers Bot\TelegramBot\CurlPost\CurlPostField\aCurlPostField
 */
class CurlPostFieldHtmlBuilderTest extends PHPUnit\Framework\TestCase
{
    private $htmlBuilder;
    private $adminBuilder;
    private $mdDuilder;

    protected function setUp(): void
    {
        $this->htmlBuilder = new CurlPostFieldHtmlBuilder();
        $this->adminBuilder = new CurlPostFieldAdminBuilder();
        $this->mdDuilder = new CurlPostFieldMdBuilder();
    }

    public function testHtml_Builder(): void
    {
        $sendMessageCurlPostField = $this->htmlBuilder
            ->init()
            ->setChatId('123456')
            ->setParse_mode('html')
            ->setText('text')
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $this->assertEquals([
            'chat_id' => '123456',
            'text' => 'text',
            'parse_mode' => 'html',
            'reply_markup' => null
            ], $curlOpt);
        
        $this->assertEquals('123456', $sendMessageCurlPostField->chatId);
    }

    public function testMd_Builder(): void
    {
        $sendMessageCurlPostField = $this->mdDuilder
            ->init()
            ->setChatId('123456')
            ->setParse_mode('html')
            ->setText('text')
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $this->assertEquals([
            'chat_id' => '123456',
            'text' => 'text',
            'parse_mode' => 'html',
            ], $curlOpt);
    }

    public function testAdmin_Builder(): void
    {
        $sendMessageAdmin = $this->adminBuilder
            ->init()
            ->setChatId('123456')
            ->setParse_mode('html')
            ->setText('text')
            ->build();

        $curlOpt = $sendMessageAdmin->getOpt();

        $this->assertEquals([
            'chat_id' => '123456',
            'text' => 'text',
            'parse_mode' => 'html',
            ], $curlOpt);
    }
    
    public function testAdmin_Builder_setMessage(): void
    {
        $sendMessageAdmin = $this->adminBuilder
            ->init()
            ->setChatId('123456')
            ->setParse_mode('html')
            ->build();

        $sendMessageAdmin->setMessage('text');
        
        $curlOpt = $sendMessageAdmin->getOpt();

        $this->assertEquals([
            'chat_id' => '123456',
            'text' => 'text',
            'parse_mode' => 'html',
            ], $curlOpt);
    }

    public function testSet_Reply_Markup_inline_keyboard_html_Builder(): void
    {
        $inlineKeyboard = 
        [
            [
                'text' => 'Прогноз на 3 дня',
                'callback_data' => 'forecast',
            ]
        ];

        $sendMessageCurlPostField = $this->htmlBuilder
            ->init()
            ->setChatId('123456')
            ->setParse_mode('html')
            ->setText('text')
            ->setReplyMarkup('inline_keyboard', $inlineKeyboard)
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();

        $this->assertEquals([
            'chat_id' => '123456',
            'text' => 'text',
            'parse_mode' => 'html',
            'reply_markup' => json_encode([
                'inline_keyboard' => [$inlineKeyboard]
            ])
            ], $curlOpt);
    }

    public function testSet_Reply_Markup_inline_keyboard_html_Builder_Exception(): void
    {
        $this->expectException(Bot\Exceptions\CommonException::class);

        $inlineKeyboard = [
                [
                    'text' => 'Прогноз на 3 дня',
                    'callback_data' => 'forecast',
                ]
        ];

        $this->htmlBuilder
            ->init()
            ->setChatId('123456')
            ->setParse_mode('html')
            ->setText('text')
            ->setReplyMarkup('false_keuborad', $inlineKeyboard)
            ->build();
    }
    
    

}
