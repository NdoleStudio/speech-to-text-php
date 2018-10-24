<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

app('router')->get('/', 'ShowWelcomeController');

app('router')->post(
    'api/weather',
    [
        'as' => 'api.weather.show',
        'uses' => 'ApiWeatherController@getWeather',
    ]
);