<?php

namespace Prometheus;

class AutoIpCityDetector extends IpCityDetector
{
    /**
     * Get city name by user's internet IP address
     *
     * @return mixed
     */
    public static function detectCity($ip)
    {
        $ip = file_get_contents('http://ipecho.net/plain');
        $location = (new Api())->getLocationByIp($ip);

        return $location->city;
    }
}