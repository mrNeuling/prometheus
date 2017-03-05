<?php

namespace Prometheus;

class IpCityDetector
{
    public static function detectCity($ip)
    {
        $api = new Api();
        
        return $api->getLocationByIp($ip);
    }
}