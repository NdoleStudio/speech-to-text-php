<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetWeatherRequest;
use App\Weather\Services\WeatherDataService;
use Illuminate\Http\JsonResponse;

class ApiWeatherController extends ApiBaseController
{
    /**
     * @var WeatherDataService
     */
    private $weatherDataService;

    /**
     * @param WeatherDataService $weatherDataService
     */
    public function __construct(WeatherDataService $weatherDataService)
    {
        $this->weatherDataService = $weatherDataService;
    }

    /**
     * @param GetWeatherRequest $request
     *
     * @return JsonResponse
     */
    public function getWeather(GetWeatherRequest $request)
    {
        $dailyWeatherData = $this->weatherDataService->getDailyWeatherData($request);

        return $this->generateOkResponse($dailyWeatherData);
    }
}
