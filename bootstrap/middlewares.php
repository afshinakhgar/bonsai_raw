<?php
$app->add(new \App\MiddleWare\AppMiddleWare($app->getContainer()));
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware($app));
$app->add(new \App\Middleware\RouterMiddleware($app->getContainer()));
$app->add(new \App\Middleware\FlashMessageMiddleWare($app->getContainer()));
