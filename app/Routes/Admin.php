<?php
$roleMiddleWare = new App\Middleware\RoleMiddleWare( 'admin' );

$app->group('/admin', function () use ($app , $route) {
    $app->group('/user', function () use ($app , $route) {
        $app->get('/list', \App\Controller\Admin\User\UserController::class.':index')->setName('admin.user.list');
    });
})->add($roleMiddleWare);
