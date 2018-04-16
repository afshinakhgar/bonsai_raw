<?php

namespace App\Controller\Admin\User;
use App\Controller\_Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends _Controller
{

    public function index(Request $request, Response $response, $args)
    {
        $list = $this->UserDataAccess->getAllUsersPaging(20);
        return $this->view->render($response, 'admin.user.index',[
            'list'=>$list
        ]);
    }
}