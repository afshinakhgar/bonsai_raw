<?php

//$route->get('/{name}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {
//    $name = $args['name'];
//
//    $response->getBody()->write("Hello, $name");
//    return $response;
//});
//
$route->get('/', \App\Controller\HomeController::class . ':index')->setName('home');






$app->get('/version', function ($request, $response, $args) {
    $filepath = __APP_ROOT__ . '.buildnumber';
    $data = file_get_contents($filepath);
    if ($data){
        $data_arr = json_decode($data);
    }else{
        $data_arr = [];
    }
    return $response->withJson($data_arr);
});


//Dynamic Routes
