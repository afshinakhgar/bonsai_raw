<?php
return  [
    'determineRouteBeforeAppMiddleware' => true,
    'addContentLengthHeader' => true,
    'displayErrorDetails' => true,
    'app' => [
        'log_timer' => true,
        'debug'=>true,
        'logger' => [
            'name' => 'cafesaba',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../storage/logs/app.logs',
        ],
    ],

];

