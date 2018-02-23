<?php
$container = $app->getContainer();

$container['logger'] = function($container) {
    $setting = $container['settings']['app']['logger'];
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler($setting['path']);
    $logger->pushHandler($file_handler);
    return $logger;
};