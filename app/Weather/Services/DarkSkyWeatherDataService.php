<?php

namespace App\Weather\Services;

use App\Weather\Clients\DarkSkyApiClient;
use App\Weather\Contracts\LocationDateTimeInput;
use App\Weather\DTOs\DailyWeatherData;
use App\Weather\Transformers\DarkSkyJsonDataToWeatherDataTransformer;

class DarkSkyWeatherDataService implements WeatherDataService
{
    /**
     * @var DarkSkyApiClient
     */
    private $darkSkyApiClient;

    /**
     * @var DarkSkyJsonDataToWeatherDataTransformer
     */
    private $darkSkyJsonDataToWeatherDataTransformer;

    /**
     * @param DarkSkyApiClient                        $darkSkyApiClient
     * @param DarkSkyJsonDataToWeatherDataTransformer $darkSkyJsonDataToWeatherDataTransformer
     */
    public function __construct(
        DarkSkyApiClient $darkSkyApiClient,
        DarkSkyJsonDataToWeatherDataTransformer $darkSkyJsonDataToWeatherDataTransformer
    ) {
        $this->darkSkyApiClient                        = $darkSkyApiClient;
        $this->darkSkyJsonDataToWeatherDataTransformer = $darkSkyJsonDataToWeatherDataTransformer;
    }

    /**
     * Gets the DailyWeatherData for a specific date.
     *
     * If we want to optimize this method, we can cache the data returned by the darkSkyApiClient such that we don't
     * call the API twice if we need to get the weather of a place twice.
     *
     * @param LocationDateTimeInput $locationDateTimeInput
     *
     * @return DailyWeatherData
     */
    public function getDailyWeatherData(LocationDateTimeInput $locationDateTimeInput): DailyWeatherData
    {
        $jsonWeatherData = $this->darkSkyApiClient->fetchWeatherData($locationDateTimeInput);

        $dailyWeatherData = $this->darkSkyJsonDataToWeatherDataTransformer->transform($jsonWeatherData);

        return $dailyWeatherData;
    }
}
