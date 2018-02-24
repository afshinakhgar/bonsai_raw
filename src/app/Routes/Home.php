<?php

$route->get('/{name}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) {
    $name = $args['name'];

    $response->getBody()->write("Hello, $name");
    return $response;
});

