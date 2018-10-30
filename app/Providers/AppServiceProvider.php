<?php

namespace App\Providers;

use App\Configurations\IbmWatsonConfiguration;
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
        $this->app->bind(IbmWatsonConfiguration::class, function () {
            return new IbmWatsonConfiguration(
                config('services.ibm.username'),
                config('services.ibm.password'),
                config('services.ibm.apiEndpoint')
            );
        });
    }
}
