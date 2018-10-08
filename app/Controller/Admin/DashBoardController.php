<?php
/**
 * Created by PhpStorm.
 * User: afshinakhgar
 * Date: 9/17/18
 * Time: 1:27 AM
 */

namespace App\Controller\Admin;

use App\Controller\_Controller;

use Slim\Http\Request;
use Slim\Http\Response;


class DashBoardController extends _Controller
{
    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'admin.dashboard.index');
    }
}