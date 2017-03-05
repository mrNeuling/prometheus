<?php

namespace Prometheus;

class Config
{
    const FORECAST_DAYS_WEEK    = 7;
    const FORECAST_API_KEY      = 'c0e88f3024b94193aee223957162706';
    const FORECAST_API_ENDPOINT = 'http://api.apixu.com/v1/forecast.json';

    public static function get($key, $lang = '', $zone = 1)
    {
        switch ($key) {
            case 'prometheus.base_dir':
                return __DIR__ . '/..';
            case 'forecast.days':
                return self::FORECAST_DAYS_WEEK;
            case 'forecast.api_key':
                return self::FORECAST_API_KEY;
            case 'forecast.api_endpoint':
                return self::FORECAST_API_ENDPOINT;
        }
    }
}