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
    
    public function testHas_Static_moonPhase(): void
    {
        $this->assertClassHasStaticAttribute('moonPhase', Weather::class);
    }
    
    public function testGet_Current_WeatherIsString():void
    {
        $this->assertIsString(Weather::getCurrentWeather());
    }
    
    public function testGet_Current_WeatherHasResult():void
    {
        $this->assertStringContainsString('Мысках', Weather::getCurrentWeather());
    }
    public function testGet_Forecast_WeatherIsString():void
    {
        $this->assertIsString(Weather::getForecastWeather());
    }
    
    public function testGet_Forecast_WeatherHasResult():void
    {
        $this->assertStringContainsString('Температура', Weather::getForecastWeather());
    }
}
