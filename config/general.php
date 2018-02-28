<?php
return  [
    'determineRouteBeforeAppMiddleware' => true,
    'addContentLengthHeader' => true,
    'displayErrorDetails' => true,
    'app' => [
        'log_timer' => true,
        'debug'=>true,
        'translation_path'=>__DIR__ . '/../translation',
        'logger' => [
            'name' => 'cafesaba',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../storage/logs/app.logs',
        ],
    ],

];

