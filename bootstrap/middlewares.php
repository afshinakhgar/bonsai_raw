<?php

$checkProxyHeaders = true; // Note: Never trust the IP address for security processes!
$trustedProxies = ['127.0.0.1', '10.0.0.2']; // Note: Never trust the IP address for security processes!
$app->add(new RKA\Middleware\IpAddress($checkProxyHeaders, $trustedProxies));

$app->add(new \App\MiddleWare\AppMiddleWare($app->getContainer()));
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware($app));
$app->add(new \App\MiddleWare\RouterMiddleWare($app->getContainer()));
$app->add(new \App\MiddleWare\FlashMessageMiddleWare($app->getContainer()));

