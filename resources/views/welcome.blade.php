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

        <meta name="description" content="This web application helps you transcribe audio files into text with just a click"/>

        <meta property="og:url" content="https://audio-to-text.ndolestudio.com/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Transcribe your audio files easily" />
        <meta property="og:description" content="This web application helps you transcribe audio files into text with just a click"/>
        <meta property="og:image" content="{{ asset('images/marketing.png') }}" />
        <meta property="og:site_name" content="Hepilo" />

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@NdoleStudio" />
        <meta name="twitter:creator" content="@NdoleStudio" />
        <meta name="twitter:author" content="@NdoleStudio" />
        <meta name="twitter:title" content="Transcribe your audio files easily" />
        <meta name="twitter:description" content="This web application helps you transcribe audio files into text with just a click"/>
        <meta name="twitter:image" content="{{ asset('images/marketing.png') }}" />

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
                <div class="text-center p-5 mb-10 bg-blue-lightest text-blue-dark border-blue border font-bold">
                    <p>
                        Select your audio file below and click on the <span class="text-red">"Transcribe Audio"</span> button to begin transcription
                    </p>
                    <br>
                    <p>Transcription takes a while. If your audio file is 2 minutes long then it will take about 2 minutes to do the transcription</p>
                </div>
                <app :pusher-key="'{{ config('broadcasting.connections.pusher.key') }}'"
                     :pusher-cluster="'{{ config('broadcasting.connections.pusher.options.cluster') }}'"></app>
            </div>
        </div>

        <div class="w-full text-center -mt-8">
            Created with ❤️ by <a class="font-bold" href="https://twitter.com/NdoleStudio" target="_blank">Ndole Studio LLC</a>.
        </div>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>