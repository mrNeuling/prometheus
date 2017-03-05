<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../src/AutoIpCityDetector.php';
require_once __DIR__.'/../src/Api.php';

class AutoIpCityDetectorTests extends TestCase
{
    private $ipCityDetector;
    private $api;
 
    protected function setUp()
    {
        $this->api = $this->createMock('Prometheus\Api');
        // $this->loc = $this->getMock('Loc');
        // $this->loc->method("")->willReturn();
        $result=new stdClass();
        $result->city='Saint Petersburg';
        $this->api->method("getLocationByIp")->willReturn($result);
        $this->autoIpCityDetector = new \Prometheus\AutoIpCityDetector();
        // $this->api = new \Prometheus\Api();
    }
 
    protected function tearDown()
    {
        $this->ipCityDetector = NULL;
    }
 
    public function testDetectCity()
    {
        $result = $this->autoIpCityDetector->detectCity($this->api);
        $this->assertEquals("Saint Petersburg", $result);
    }
 
}