# Prometheus

## Story

Prometheus is an application to predict future by applying advanced artificial intelligence algorithms.
You are hired as a new PHP developer to maintain and improve it.

## Issue

Some customers report that predictions take too long to complete and some of them are wrong.
You dive into the issue and discover a strange legacy module which probably contains a bug.

## Objective

- Figure out how to run and debug the module.
- Reverse engineer the code to understand how it works.
- Refactor the module and improve the overall code quality and testability.
- Cover the module's code with unit tests. (optional)
- Fix any bugs you may find. (optional)

## Rules

- Module has a single entry point - weather.php.
- You cannot change interface of WeatherForecaster class (weather.php file must remain unchanged).
- Config and Api classes must remain intact, because they are used in other modules.
- You can modify text of error messages.
- Only PHPUnit can be used for testing.
