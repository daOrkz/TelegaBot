<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
/**
 * Description of InitWebHookTest
 *
 * @author fillipp
 */

/**
 * @covers \Bot\InitWebHook\InitWebHook::__construct
 * @covers \Bot\InitWebHook\InitWebHook::__get
 * @covers \Bot\InitWebHook\InitWebHook::generateURL
 * @covers \Bot\InitWebHook\InitWebHook::init
 *
 * @group InitWebHook
 * @group fulltest
 */

class InitWebHookTest extends PHPUnit\Framework\TestCase
{
    private $initWebHook;
    
    protected function setUp(): void
    {
//        $this->config = parse_ini_file(include(dirname(__FILE__).'/../../../config.ini'));
        $this->config = parse_ini_file(dirname(__FILE__).'/../../../config.ini');
        $this->initWebHook = new \Bot\InitWebHook\InitWebHook($this->config);
    }
    
    public function testGenerateUrl(): void
    {
        $expected = $this->config['apiTelegramUrl'] . $this->config['token'];
        $this->assertEquals($expected, $this->initWebHook->Url);
    }
    
    public function testInitHasArray():void
    {
        $this->assertIsArray($this->initWebHook->init());
    }
    
    public function testInitHasResult():void
    {
        $this->assertArrayHasKey('ok', $this->initWebHook->init());
    }
    
    public function testMegicGet(): void
    {
        $this->assertEquals($this->config, $this->initWebHook->config);
    }
    
    
    public function testException(): void
    {
        $this->expectException(Bot\Exceptions\CurlException::class);
        $initWebHook = new \Bot\InitWebHook\InitWebHook(['apiTelegramUrl' => '', 'token' => '', 'ngrokURL' => '']);
        $initWebHook->init();
    }
}
