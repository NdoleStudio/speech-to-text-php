<?php

namespace App\Providers;

use App\Weather\Configurations\DarkSkyApiConfiguration;
use App\Weather\Services\DarkSkyWeatherDataService;
use App\Weather\Services\WeatherDataService;
use DavidePastore\Ipinfo\Ipinfo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(DarkSkyApiConfiguration::class, function () {
            return new DarkSkyApiConfiguration(
                config('services.darksky.excludedBlocks'),
                config('services.darksky.apiEndpoint'),
                config('services.darksky.units')
            );
        });

        $this->app->bind(WeatherDataService::class, DarkSkyWeatherDataService::class);

        $this->app->bind(Ipinfo::class, function () {
            return new Ipinfo([
                'token' => config('services.ipinfo.accessToken')
            ]);
        });
    }
}
