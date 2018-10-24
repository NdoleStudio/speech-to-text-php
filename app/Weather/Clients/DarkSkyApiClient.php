<?php

namespace App\Weather\Clients;

use App\Weather\Configurations\DarkSkyApiConfiguration;
use App\Weather\Contracts\LocationDateTimeInput;
use GuzzleHttp\Client;
use stdClass;

class DarkSkyApiClient
{
    /**
     * @var DarkSkyApiConfiguration
     */
    private $darkSkyApiConfiguration;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @param DarkSkyApiConfiguration $darkSkyApiConfiguration
     * @param Client                  $httpClient
     */
    public function __construct(DarkSkyApiConfiguration $darkSkyApiConfiguration, Client $httpClient)
    {
        $this->darkSkyApiConfiguration = $darkSkyApiConfiguration;
        $this->httpClient              = $httpClient;
    }

    /**
     * @param LocationDateTimeInput $locationDateTimeInput
     *
     * @return stdClass
     */
    public function fetchWeatherData(LocationDateTimeInput $locationDateTimeInput): stdClass
    {
        $requestUrl = $this->buildRequestUrl($locationDateTimeInput);

        $responseData = $this->httpClient->get($requestUrl);

        return json_decode($responseData->getBody()->getContents());
    }

    /**
     * @param LocationDateTimeInput $locationDateTimeInput
     *
     * @return string
     */
    private function buildRequestUrl(LocationDateTimeInput $locationDateTimeInput): string
    {
        $urlParameters = implode(
            ',',
            [
                $locationDateTimeInput->getLatitude(),
                $locationDateTimeInput->getLongitude(),
                $locationDateTimeInput->getDateTime()->getTimestamp(),
            ]
        );

        $baseUrl = $this->darkSkyApiConfiguration->getApiEndpoint() . $urlParameters;

        $excludeParameters = 'exclude=' . implode(',', $this->darkSkyApiConfiguration->getExcludedBlocks());
        $unitParameter     = 'units=' . $this->darkSkyApiConfiguration->getUnits();

        $getParameters = implode('&', [$excludeParameters, $unitParameter]);

        return implode('?', [$baseUrl, $getParameters]);
    }
}
