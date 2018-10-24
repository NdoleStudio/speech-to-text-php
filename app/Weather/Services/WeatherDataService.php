<?php

namespace App\Weather\Services;

use App\Weather\Contracts\LocationDateTimeInput;
use App\Weather\DTOs\DailyWeatherData;

interface WeatherDataService
{
    /**
     * Gets the DailyWeatherData for a specific date.
     *
     * @param LocationDateTimeInput $locationDateTimeInput
     *
     * @return DailyWeatherData
     */
    public function getDailyWeatherData(LocationDateTimeInput $locationDateTimeInput): DailyWeatherData;
}
