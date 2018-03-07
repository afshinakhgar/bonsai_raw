<?php
$app->group('/demo', function () use ($route) {
    $route->get('/api/{name}', \App\Controller\Api\V1\DemoController::class.':index')->setName('demo.api');
    $route->get('/benchmark', \App\Controller\Api\V1\DemoController::class.':benchmark')->setName('demo.benchmark');
});