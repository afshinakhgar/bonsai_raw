<?php
$app->group('/api', function ($app) use ($route) {
	$app->group('/v1', function () use ($route) {
		$route->post('/user/authenticate/login', \App\Controller\Api\V1\User\AuthenticateController::class.':login')->setName('api.login');
		$route->post('/user/authenticate/register', \App\Controller\Api\V1\User\AuthenticateController::class.':register')->setName('api.register');
	});
});
