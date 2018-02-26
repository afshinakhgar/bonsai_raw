<?php

// load database settings from app configuration to avoid configuration redundance
include 'bootstrap/app.php';
$db_settings = $config['settings']['databases']['db'];
return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds',
    ],

    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'db',
        'db' => [
            'adapter' => $db_settings['driver'],
            'host' => $db_settings['host'],
            'name' => $db_settings['database'],
            'user' => $db_settings['username'],
            'pass' => $db_settings['password'],
            'port' => $db_settings['port'],
            'charset' => $db_settings['charset'],
        ],
    ],
];
