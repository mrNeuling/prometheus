<?php

namespace Prometheus;

class Api
{
    /**
     * Returns weather forecast
     *
     * @param string $days
     * @param string $city
     * @return mixed
     * @throws WeatherForecastException
     */
    public function getWeatherForecast($days, $city)
    {
        $apiKey = Config::get('forecast.api_key');
        $url = Config::get('forecast.api_endpoint') . '?key=' . $apiKey . '&q=' . urlencode($city) . '&days=' . $days;

        $response = $this->query($url);

        if (false === $response || null === $response) {
            throw new \Exception("External weather forecast provider API returned and invalid response");
        }

        return $response;
    }

    /**
     * Returns city name by IP address
     *
     * @param string $ip
     * @return mixed
     */
    public function getLocationByIp($ip)
    {
        return json_decode(file_get_contents('http://freegeoip.net/json/' . $ip));
    }

    /**
     * Sends a request, receives response, decodes json and returns object
     *
     * @param string $url
     * @return mixed
     */
    private function query($url)
    {
        return json_decode(file_get_contents($url));
    }
}