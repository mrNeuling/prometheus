<?php

namespace Prometheus;

class WeatherForecaster
{
    public static $cache;
    private static $api;

    public function __construct() {
        self::$cache = include_once dirname(__FILE__)."/../cache.php";
        self::$api = new Api();
    }

    /**
     * Prints weather forecast
     *
     * @throws Exception
     */
    public static function printForecast($test = false)
    {
        $city = self::getCity($test);
        $days = Config::get('forecast.days');

        $response = self::getForecast($city, $days);

        echo "Date,Temp,Conditions\n";
        // print forecast
        echo $city."\n";
        foreach ($response->forecast->forecastday as $day) {
            echo $day->date . ',' . $day->day->avgtemp_c . '°,' . $day->day->condition->text . "\n";
        }
    }

    /**
     * Get city name
     * 
     * @param int    $days
     * @param string $city
     * @return mixed
     * @throws Exception
     */
    private static function getCity($test) {
        $namePos = $test?2:1;
        if (isset($_SERVER['argc']) && $_SERVER['argc'] > $namePos) {
            // read city from command line arguments
            $city = implode(' ', array_slice($_SERVER['argv'], $namePos));
        } else {
            $city = AutoIpCityDetector::detectCity(self::$api);
        }
        return $city;
    }

    /**
     * Get weather forecast for specified city
     * 
     * @param int    $days
     * @param string $city
     * @return mixed
     * @throws Exception
     */
    private static function getForecast($city, $days) 
    {
        if (self::$cache->has($city)) {
            $response = self::$cache->get($city);
            if(strtotime($response->current->last_updated) > (time()-60*60) && count($response->forecast->forecastday) == $days ) {
                return $response;
            }
        } 

        $response = self::fetchDayCityForecast($days, $city);
        $response->current->last_updated = date("Y-m-d H:i", time());
        self::$cache->put($response, $city);

        return $response;
    }

    /**
     * Get weather forecast for specified city and days
     *
     * @param int    $days
     * @param string $city
     * @return mixed
     * @throws Exception
     */
    private static function fetchDayCityForecast($days, $city)
    {
        $response = self::$api->getWeatherForecast($days, $city);

        if (isset($response->error)) {
            if ($response->error->code === 1006) {
                throw new \Exception("Cannot retreive weather forecast in specified city");
            }

            throw new \Exception('Unexpected external weather forecast provider API error: ' . $response->error->message . "\n");
        }

        return $response;
    }
}