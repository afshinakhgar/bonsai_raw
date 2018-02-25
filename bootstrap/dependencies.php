<?php
$container = $app->getContainer();

$container['logger'] = function($container) {
    $setting = $container['settings']['app']['logger'];
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler($setting['path']);
    $logger->pushHandler($file_handler);
    return $logger;
};




/* database connection */
$container['db'] = function ($container) {
    $db = $container['settings']['databases']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'],
        $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};


$container['generalErrorHandler'] = function ($container) {
    return new \Kernel\Handlers\ErrorHandler($container['logger']);
};