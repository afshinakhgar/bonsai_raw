<?php
$app->group('/demo', function () use ($route) {
    $route->get('/api', \App\Controller\Api\V1\DemoController::class.':index')->setName('demo.api');
});