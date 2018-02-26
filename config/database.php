<?php
return [
    'databases'=>[
        'db' => [
            'driver'    => envY(__APP_ROOT__,'DB_DRIVER', 'mysql'),
            'host'      => envY(__APP_ROOT__,'DB_HOST', 'localhost'),
            'database'  => envY(__APP_ROOT__,'DB_NAME', 'bonsai'),
            'username'  => envY(__APP_ROOT__,'DB_USERNAME', 'root'),
            'password'  => envY(__APP_ROOT__,'DB_PASS', 'root'),
            'charset'   => envY(__APP_ROOT__,'DB_CHARSET', 'utf8'),
            'collation' => envY(__APP_ROOT__,'DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => envY(__APP_ROOT__,'DB_PREFIX', ''),
            'port'      => envY(__APP_ROOT__,'DB_PORT', 3306),
        ],
    ]
];