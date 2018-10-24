<?php

namespace App\Weather\DTOs;

use JsonSerializable;

class DailyWeatherData implements JsonSerializable
{
    const HOUR_MORNING   = 7;
    const HOUR_AFTERNOON = 13;
    const HOUR_EVENING   = 19;

    /**
     * @var HourlyWeatherData
     */
    private $morningWeather;

    /**
     * @var HourlyWeatherData
     */
    private $afternoonWeather;

    /**
     * @var HourlyWeatherData
     */
    private $eveningWeather;

    /**
     * @param HourlyWeatherData $morningWeather
     * @param HourlyWeatherData $afternoonWeather
     * @param HourlyWeatherData $eveningWeather
     */
    public function __construct(
        HourlyWeatherData $morningWeather,
        HourlyWeatherData $afternoonWeather,
        HourlyWeatherData $eveningWeather
    ) {
        $this->morningWeather   = $morningWeather;
        $this->afternoonWeather = $afternoonWeather;
        $this->eveningWeather   = $eveningWeather;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'morning'   => $this->morningWeather->jsonSerialize(),
            'afternoon' => $this->afternoonWeather->jsonSerialize(),
            'evening'   => $this->eveningWeather->jsonSerialize(),
        ];
    }
}
