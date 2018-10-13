<?php

namespace App\Controller\Admin;
use App\Controller\_Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class SearchController extends _Controller
{

    public function search(Request $request, Response $response, $args)
    {

        $query = $_GET['q'];




        $list =  $this->SearchDataAccess->query($query,10);

        $pagingData = $this->PagerHelper->pagingData($request,$list,10);
        return $this->view->render($response, 'admin.user.index',[
            'list'=>$list,
            'pagination'=>$pagingData
        ]);

    }
}