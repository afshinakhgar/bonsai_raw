<?php
$app->group('/api', function ($app) use ($route) {
	$app->group('/v1', function () use ($route) {
		$route->post('/user/auhtenticate/login', \App\Controller\Api\V1\User\Authenticate::class.':login')->setName('api.login');
	});
});
