<?php

namespace Prometheus;

class AutoIpCityDetector
{
    /**
     * Get city name by user's internet IP address
     *
     * @param Api $api
     * @return mixed
     * @throws Exception
     */
    public static function detectCity(Api $api)
    {
        $ip = self::detectIp();
        $location = $api->getLocationByIp($ip);

        if(null === $location || !isset($location->city)) {
            throw new \Exception("Cannot specify city by IP");
        }

        return $location->city;
    }

    private static function detectIp() {
        $ip = file_get_contents('http://ipecho.net/plain');
        return $ip;
    }

}