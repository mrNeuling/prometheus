#!/usr/bin/env php
<?php

include 'bootstrap.php';

$forecaster = new \Prometheus\WeatherForecaster();
$forecaster->printForecast();