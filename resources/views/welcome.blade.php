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

        <title>Audio To Text Translator️ | Ndole Studio</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content mt-20 pb-10" id="site-content">
                <div class="title">
                    Audio To Text
                </div>
                <app></app>
            </div>
        </div>

        <div class="w-full text-center -mt-8">
            Created with ❤️ by <a class="font-bold" href="https://twitter.com/ndolestudio" target="_blank">Ndole Studio LLC</a>.
        </div>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>