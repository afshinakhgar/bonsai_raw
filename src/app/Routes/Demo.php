<?php
$app->group('/demo', function () use ($app , $route) {
    $app->get('/api', \App\Controller\Api\V1\DemoController::class.':index')->setName('admin.user.userrole');
});