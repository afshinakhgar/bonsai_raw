<?php
return  [
    'determineRouteBeforeAppMiddleware' => true,
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,
    'app' => [
        'log_timer' => true,
        'debug'=>false,
        'logger' => [
            'name' => 'cafesaba',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../storage/logs/app.logs',
        ],
    ],
	'localization'=> [
		'translation_path'=>__DIR__ . '/../translation',
		'lang' => 'en'
	]

];

