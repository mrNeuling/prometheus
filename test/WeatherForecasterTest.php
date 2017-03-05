<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../src/WeatherForecaster.php';
require_once __DIR__.'/../src/Config.php';
require_once __DIR__.'/../src/Api.php';
require_once __DIR__.'/../src/AutoIpCityDetector.php';

class WeatherForecasterTests extends TestCase
{
    private $api;
 
    protected function setUp()
    {
        $this->api = $this->createMock('Prometheus\Api');
        $result=new stdClass();
        $result->city='Saint Petersburg';
        $this->api->method("getLocationByIp")->willReturn($result);
        $this->weatherForecaster = new \Prometheus\WeatherForecaster();
    }
 
    protected function tearDown()
    {
        $this->weatherForecaster = NULL;
    }
 
    public function testPrintForecast()
    {
        $result = $this->weatherForecaster->printForecast(true);
        $this->assertNull($result);
    }

}