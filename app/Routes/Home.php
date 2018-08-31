<?php

//$route->get('/{name}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {
//    $name = $args['name'];
//
//    $response->getBody()->write("Hello, $name");
//    return $response;
//});
//
$route->get('/', \App\Controller\HomeController::class . ':index')->setName('home');




// Routes and middleware structure
$routArr = array(
    /*  'Movie' => array(
          '*' => array(
              '*' => array('middleWares' => array(
                  array('class' => 'TokenAuthorization', 'method' => '__invoke', 'exceptions'=> array()),
              ))
          )
      ),*/
    'User' => array(
        'Account' => array(
            'change_mypassword' => array('middleWares' => array(
                array('class' => 'TokenAuthorization', 'method' => '__invoke', 'exceptions'=> array()),
            )),
            'validate_mobile_live_step1' => array('middleWares' => array(
                array('class' => 'RateLimiter', 'method' => '__invoke', 'exceptions'=> array()),
            ))
        )
    ),

);


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
