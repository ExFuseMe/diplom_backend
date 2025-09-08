<?php

return [
    'seeder_creds' => [
        'admin' => [
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD'),
        ],
        'proforg' => [
            'email' => env('PROFORG_MAIL'),
            'password' => env('PROFORG_PASSWORD'),
        ]
    ],
    'horizon' => [
        'email' => env('AUTH_BASIC_ADMIN_LOGIN'),
        'password' => env('AUTH_BASIC_ADMIN_PASSWORD'),
    ]
];
