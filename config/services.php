<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '396530715508-ad4fo49vhcdiu5qoa847odruvgrb0bt8.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
      ],
      'github' => [
        'client_id' => '26095ae79662e6ac2bd4',
        'client_secret' => '2fed53ab2f2e546a2266a84b08de2c7cbc9755be',
        'redirect' => 'http://127.0.0.1:8000/callback/github',
    ],

];
