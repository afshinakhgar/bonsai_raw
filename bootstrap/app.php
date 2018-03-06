<?php
//ini_set('display_errors', 1);
define('__APP_ROOT__', __DIR__ . '/../') ;
require __APP_ROOT__ . 'vendor/autoload.php';
require __APP_ROOT__ . 'kernel/Helpers/Functions/general_helpers.php';
// start config files reader


$configFilesObj = new \Kernel\Helpers\ConfigHelper();
$config['settings'] = $configFilesObj->loader(__APP_ROOT__.'/config/');

$app = new \Kernel\App($config);

if($config['settings']['app']['debug']){
    error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

require __APP_ROOT__ . 'bootstrap/dependencies.php';

$route = new \Kernel\Router($app);

$route->partialRouterLoader(__APP_ROOT__.'app/Routes/');

if(php_sapi_name() != 'cli') {
    SlimFacades\Facade::setFacadeApplication($app);
    require  __APP_ROOT__.'bootstrap/middlewares.php';
    $app->run();
}


