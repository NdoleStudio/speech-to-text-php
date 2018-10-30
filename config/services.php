<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'ibm' => [
        'username' => env('SPEECH_TO_TEXT_USERNAME'),
        'password' => env('SPEECH_TO_TEXT_PASSWORD'),
        'apiEndpoint' => env('SPEECH_TO_TEXT_API_ENDPOINT'),
    ],
];
