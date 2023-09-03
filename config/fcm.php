<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' =>  'AAAAVVtz2sQ:APA91bG8FMsKDpK4pj52THerAqCmlFkChJVjyXsdMzpzSxo6escp8MDGkXD7Odso2dKd3LxhpKw6bouDM3fvjMSa5ZM55VANEJLGqFGBjrgD46cUBgP-BcMF3KfjPC0NZHAMtZYSIFIA',
        'sender_id' => '366606539460',
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
