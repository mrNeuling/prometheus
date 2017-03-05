<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../src/Api.php';
require_once __DIR__.'/../src/Config.php';

class ApiTests extends TestCase
{
    private $api;
    protected $fixture;
 
    protected function setUp()
    {
        $this->fixture = new \Prometheus\Api();
    }
 
    protected function tearDown()
    {
        $this->fixture = NULL;
    }
 
    public function testGetLocationByIp()
    {
        $result = $this->fixture->getLocationByIp("178.66.53.193");
        $this->assertEquals("Saint Petersburg", $result->city);
    }

    /** 
    * @dataProvider providerGetWeatherForecast 
    */
    public function testGetWeatherForecast($days, $city)
    {
        $result = $this->fixture->getWeatherForecast($days, $city);
        $this->assertFalse(isset($result->error));
    }

    public function providerGetWeatherForecast() {
        return array( array(7, "Saint Petersburg") );
    }
 
}