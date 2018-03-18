<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends _Controller
{

    public function index(Request $request, Response $response, $args)
    {
        dd(2);
    }
}