<?php
define('__APP_ROOT__', __DIR__ . '/../') ;

require __APP_ROOT__ . 'vendor/autoload.php';

// start config files reader
$configFilesObj = new \Kernel\Helpers\ConfigHelper();
$config = $configFilesObj->loader(__APP_ROOT__.'/config/');
var_dump($config);exit;
$app = new \Kernel\App($config);


$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->run();