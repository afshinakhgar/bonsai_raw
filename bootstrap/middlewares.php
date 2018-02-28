<?php
$app->add(new \App\MiddleWare\AppMiddleWare($app->getContainer()));

$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware($app));
