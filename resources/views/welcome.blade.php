<?php
/**
 * @var \DavidePastore\Ipinfo\Host $host
 */
?>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

        <title>Made With ❤️ | Weather App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link href="{{mix('css/vendor.css')}}" rel="stylesheet" type="text/css">
        <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content mt-20 pb-10" id="site-content">
                <div class="title">
                    Weather App
                </div>
                <app :date-picker-start-date="'{{ now()->subDay(30)->toDateString() }}'"
                         :date-picker-end-date="'{{ now()->addDay(7)->toDateString() }}'"
                         :weather-api-url="'{{ route('api.weather.show') }}'"
                         :longitude="'{{ explode(',', $host->getLoc())[1] }}'"
                         :latitude="'{{ explode(',', $host->getLoc())[0] }}'"
                         :place="'{{ $host->getCity() . ', ' . $host->getRegion() }}'">
                </app>
            </div>
        </div>

        <div class="bottom">
            Weather by <a class="text-blue" href="https://darksky.net/poweredby/">Dark Sky</a> and icons by <a class="text-blue" href="https://www.amcharts.com/free-animated-svg-weather-icons/">AmCharts</a>
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA84Z-Cz4zRAX-iJB2qAZ9mIMscFGaH57M&libraries=places"></script>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>