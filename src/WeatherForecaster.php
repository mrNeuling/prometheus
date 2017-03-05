<?php

namespace Prometheus;

class WeatherForecaster
{
    public static $cache;

    /**
     * Prints weather forecast
     */
    public static function printForecast()
    {
        if ($_SERVER['argc'] > 1) {
            // read city from command line arguments
            $city = implode(' ', array_slice($_SERVER['argv'], 1));
        } else {
            $city = AutoIpCityDetector::detectCity(null);
        }

        $days = Config::get('forecast.days');

        if (self::$cache->has($city)) {
            $response = self::$cache->get($city);
        } else {
            $response = self::fetchDayCityForecast($days, $city);
        }

        self::$cache->put($response, $city);

        echo "Date,Temp,Conditions\n";
        // print forecast
        foreach ($response->forecast->forecastday as $day) {
            echo $day->date . ',' . $day->day->avgtemp_c . '°,' . $day->day->condition->text . "\n";
        }
    }

    /**
     * Prints weather forecast for specified city and days
     *
     * @param int    $days
     * @param string $city
     * @return mixed
     */
    private static function fetchDayCityForecast($days, $city)
    {
        $api = new Api();
        $response = $api->getWeatherForecast($days, $city);

        if (isset($response->error)) {
            if ($response->error->code === 1006) {
                throw new \Exception("Cannot retreive weather forecast in specified city");
            }

            throw new \Exception('Unexpected external weather forecast provider API error: ' . $response->error->message . "\n");
        }

        return $response;
    }
}