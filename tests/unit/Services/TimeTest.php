<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
/**
 * Description of TimeTest
 *
 * @author fillipp
 */
use Bot\Services\Time as Time;

/**
 * @covers \Bot\Services\Time::getTime
 *
 * @group Services
 * @group fulltest
 */
class TimeTest extends PHPUnit\Framework\TestCase
{
    
    public function testInitHasArray():void
    {
        $this->assertIsArray(Time::getTime());
    }
    
    public function testGet_TimeHasKeyTime():void
    {
        $this->assertArrayHasKey('time', Time::getTime());
    }
    
}
