<?php

return [
    'APP_TITLE' => 'alishahidinet',
    'TOKEN' => 'env',
    'CRYPT_TOKEN' => 'env',
    'BASE_URL' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://'.$_SERVER['HTTP_HOST'] : 'http://'.$_SERVER['HTTP_HOST'],
    'BASE_DIR' => dirname(__DIR__),
    'ERRORS' => [
        '400' => 'app.errors.400',
        '401' => 'app.errors.401',
        '404' => 'app.errors.404',
    ],
    'PROVIDERS' => [
        \App\Providers\HomeServiceProvider::class,
    ],
    'UN_VERIFY_TOKEN_ROUTE' => [],
];
