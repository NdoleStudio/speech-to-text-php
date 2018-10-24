<?php

namespace App\Weather\DTOs;

use JsonSerializable;

class HourlyWeatherData implements JsonSerializable
{
    /**
     * @var string
     */
    private $summary;

    /**
     * @var string
     */
    private $iconUrl;

    /**
     * @var float
     */
    private $temperature;

    /**
     * @var float
     */
    private $apparentTemperature;

    /**
     * @var float
     */
    private $humidity;

    /**
     * @var float
     */
    private $windSpeed;

    /**
     * @param string $summary
     * @param string $iconUrl
     * @param float  $temperature
     * @param float  $apparentTemperature
     * @param float  $humidity
     * @param float  $windSpeed
     */
    public function __construct(
        string $summary,
        string $iconUrl,
        float $temperature,
        float $apparentTemperature,
        float $humidity,
        float $windSpeed
    ) {
        $this->summary             = $summary;
        $this->iconUrl             = $iconUrl;
        $this->temperature         = $temperature;
        $this->apparentTemperature = $apparentTemperature;
        $this->humidity            = $humidity;
        $this->windSpeed           = $windSpeed;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'summary'             => $this->summary,
            'iconUrl'             => $this->iconUrl,
            'temperature'         => $this->temperature,
            'apparentTemperature' => $this->apparentTemperature,
            'humidity'            => $this->humidity,
            'windSpeed'           => $this->windSpeed,
        ];
    }
}
