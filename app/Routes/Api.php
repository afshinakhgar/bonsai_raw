<?php

$app->group('/api', function ($app) use ($route) {
    $app->group('/v1', function () use ($route,$app) {
        $route->post('/user/authenticate/login', \App\Controller\Api\V1\User\AuthenticateController::class.':login')->setName('api.login');
        $route->post('/user/authenticate/register', \App\Controller\Api\V1\User\AuthenticateController::class.':register')->setName('api.register');

        $middlewareLogin = (new \Tuupola\Middleware\JwtAuthentication([
            "path" => "/api", /* or ["/api", "/admin"] */
            "attribute" => "decoded_token_data",
            "secret" => "afshinxirantehrsdsantestiboxsecretafshinirancxsz",
            "algorithm" => ["HS256"],
            "error" => function ($response, $arguments) {
                $data["status"] = "error";
                $data["message"] = $arguments["message"];
                return $response
                    ->withHeader("Content-Type", "application/json")
                    ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }
        ]));



        $app->group('/user', function () use ($route) {
            $route->get('/list', \App\Controller\Api\V1\User\UserController::class.':index')->setName('api.user.list');
            $route->get('/show/{username}', \App\Controller\Api\V1\User\UserController::class.':show')->setName('api.user.show');
            $route->get('/attend_exam/{exam_id}', \App\Controller\Api\V1\User\UserController::class.':attend_exam')->setName('api.user.attend_exam');
        })
            ->add($middlewareLogin);

//        ;
    });
});