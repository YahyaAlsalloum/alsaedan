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
        'client_id' => '366606539460-uop4rjr2hdq56jh9ef0ldved3ljqjhhl.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://halaevent.com/auth/google/callback'
    ],

    'facebook' => [
        'client_id' => '401404885387734',
        'client_secret' =>'953881c65aee7a2e7fd21c3cbbab4638',
        'redirect'=>'https://halaevent.com/callback/facebook'
    ],

    "apple" => [
        "client_id" => "com.dowgroup.halaevent.client",
        "client_secret" => "MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgOVBuyBEOTbj3V5WHoCswkzmMHCKIQNG0f/Mt0NSzGyqgCgYIKoZIzj0DAQehRANCAASRzHzBUC7axxTDCItyA6vgSEXUkVliJJNSdUvApliCn05457dYCRJQtbUaf6OFKSZlCUlpwvNJSePQ2QvRQKV2",
        'redirect'=>'https://halaevent.com/callback/apple'
    ],
    "instagram" => [
        "client_id" => "1168605794032906",
        "client_secret" => "f13bf232d5bdf34502feafbf442971bf",
        'redirect'=>'https://halaevent.com/callback/instagram'
    ],

];
