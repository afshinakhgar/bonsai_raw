<?php


$app->group('/user', function () use ($app , $route) {
    $route->get('/register', \App\Controller\User\AuthController::class . ':get_create')->setName('auth.register');
    $route->post('/register', \App\Controller\User\AuthController::class . ':post_create')->setName('auth.register');

    $route->get('/login', \App\Controller\User\AuthController::class . ':get_login')->setName('auth.login');
    $route->post('/login', \App\Controller\User\AuthController::class . ':post_login')->setName('auth.login');
    $route->get('/logout', \App\Controller\User\AuthController::class . ':get_logout')->setName('auth.logout');

});
