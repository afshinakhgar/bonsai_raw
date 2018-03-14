<?php


$app->group('/register', function () use ($app , $route) {

    $route->get('/register', \App\Controller\User\AuthController::class . ':get_create')->setName('register');
    $route->post('/register', \App\Controller\User\AuthController::class . ':post_create')->setName('register');
});