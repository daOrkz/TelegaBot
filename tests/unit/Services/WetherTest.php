<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
/**
 * Description of WetherTest
 *
 * @author fillipp
 */

use Bot\Services\Weather as Weather;


/**
 * @covers Bot\Services\Weather
 * 
 * @group Services
 * @group fulltest
 */
class WetherTest extends PHPUnit\Framework\TestCase
{
    private $weather;
    
    protected function setUp(): void
    {
        $this->weather = new Weather();
    }
    public function testCurrent_Weather_Url(): void
    {
        $this->assertEquals('https://weatherapi-com.p.rapidapi.com/current.json?q=53.45154224%2C87.38461796', Weather::$currentWeatherUrl);
    }
    
    public function testForecast_Weather_Url(): void
    {
        $this->assertEquals('https://weatherapi-com.p.rapidapi.com/forecast.json?q=53.45154224%2C87.38461796&days=3', Weather::$forecastWeatherUrl);
    }
    
    public function test_getCurrentWeather_return_Array(): void
    {
        $this->assertIsArray($this->weather->getCurrentWeather());
    }
    
    public function test_get_Current_WeatherHasResult():void
    {
        $this->assertArrayHasKey('current', Weather::getCurrentWeather());
    }
    
    public function test_getForecastWeather_return_Array(): void
    {
        $this->assertIsArray($this->weather->getForecastWeather());
    }
    
    public function testGet_Forecast_WeatherHasResult():void
    {
        $this->assertArrayHasKey('forecast', Weather::getForecastWeather());
    }
    
}
