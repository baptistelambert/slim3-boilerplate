<?php

$settings = [];

$settings['settings']['debug'] = true;

$settings['settings']['doctrine'] = [
    'meta' => [
        'entity_path' => [
            'src/Entity'
        ],
        'auto_generate_proxies' => true,
        'proxy_dir' => __DIR__ . '/app/tmp/cache/proxies',
        'cache' => null,
    ],
    'connection' => [
        'driver' => 'pdo_mysql',
        'host' => '127.0.0.1',
        'dbname' => 'slim3boilerplate',
        'user' => 'root',
        'password' => '',
    ],
];

$settings['settings']['displayErrorDetails'] = $settings['settings']['debug'];

return $settings;