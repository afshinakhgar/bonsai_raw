<?php
define('__APP_ROOT__', __DIR__ . '/../') ;

require __APP_ROOT__ . 'vendor/autoload.php';

// start config files reader
$configFilesObj = new \Kernel\Helpers\ConfigHelper();
$config['settings'] = $configFilesObj->loader(__APP_ROOT__.'/config/');



$app = new \Kernel\App($config);

require __APP_ROOT__ . 'bootstrap/dependencies.php';


$app->get('/hello/{name}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {
    $name = $args['name'];

    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->run();