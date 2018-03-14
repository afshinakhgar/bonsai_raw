<?php

namespace App\Controller\User;
use App\Controller\_Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AuthController extends _Controller
{
    public function get_create(Request $request , Response $response )
    {
        return $this->view->render($response, 'auth.register');
    }


    public function post_create(Request $request , Response $response )
    {

    }

}