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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'esewa' => [
    'product_code' => env('ESEWA_PRODUCT_CODE', 'EPAYTEST'),
    'secret_key'   => env('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q'),
    'form_url'     => env('ESEWA_FORM_URL', 'https://rc-epay.esewa.com.np/api/epay/main/v2/form'),
    'status_url'   => env('ESEWA_STATUS_URL', 'https://rc.esewa.com.np/api/epay/transaction/status/'),
],

'khalti' => [
    'secret_key'   => env('KHALTI_SECRET_KEY', 'live_secret_key_68791341fdd94846a146f0457ff7b455'),
    'initiate_url' => env('KHALTI_INITIATE_URL', 'https://dev.khalti.com/api/v2/epayment/initiate/'),
    'lookup_url'   => env('KHALTI_LOOKUP_URL', 'https://dev.khalti.com/api/v2/epayment/lookup/'),
],

    'abstract_email' => [
        'api_key' => env('ABSTRACT_EMAIL_API_KEY', 'c4260c6e04c8434a8528b038f722d410'),
    ],

];
