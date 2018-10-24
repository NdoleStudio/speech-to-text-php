<?php

namespace App\Weather\Transformers;

use App\Weather\DTOs\DailyWeatherData;
use App\Weather\DTOs\HourlyWeatherData;
use stdClass;

class DarkSkyJsonDataToWeatherDataTransformer
{
    /**
     * This method converts the JSON weather data from the dark sky API into a valid DailyWeatherData instance.
     *
     * @param stdClass $weatherJsonData
     *
     * @return DailyWeatherData
     */
    public function transform(stdClass $weatherJsonData)
    {
        return new DailyWeatherData(
            $this->getHourlyWeatherData(DailyWeatherData::HOUR_MORNING, $weatherJsonData),
            $this->getHourlyWeatherData(DailyWeatherData::HOUR_AFTERNOON, $weatherJsonData),
            $this->getHourlyWeatherData(DailyWeatherData::HOUR_EVENING, $weatherJsonData)
        );
    }

    /**
     * @param int      $hour
     * @param stdClass $jsonData
     *
     * @return HourlyWeatherData
     */
    private function getHourlyWeatherData(int $hour, stdClass $jsonData): HourlyWeatherData
    {
        return new HourlyWeatherData(
            $jsonData->hourly->data[$hour]->summary,
            $this->formatWeatherIcon($jsonData->hourly->data[$hour]->icon),
            $jsonData->hourly->data[$hour]->temperature,
            $jsonData->hourly->data[$hour]->apparentTemperature,
            $this->formatHourlyHumidity($jsonData->hourly->data[$hour]->humidity),
            $jsonData->hourly->data[$hour]->windSpeed
        );
    }

    /**
     * @param float $humidity
     *
     * @return float
     */
    private function formatHourlyHumidity(float $humidity): float
    {
        return round($humidity * 100, 2);
    }

    /**
     * @param string $weatherIcon
     *
     * @return string
     */
    private function formatWeatherIcon(string $weatherIcon): string
    {
        return asset('/images/animated/' . $weatherIcon . '.svg');
    }
}
