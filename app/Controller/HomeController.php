<?php

namespace App\Controller;

use Kernel\Facades\Auth;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends _Controller
{

    public function index(Request $request, Response $response, $args)
    {
        dd(Auth::check());

        //        Sms::send('سلام',['0922']);

    }
}