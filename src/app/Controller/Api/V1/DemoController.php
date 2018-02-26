<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 12:04 PM
 */

namespace App\Controller\Api\V1;


use App\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class DemoController
 * @package App\Controller\Api\V1
 */
class DemoController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function index(Request $request , Response $response , array $args)
    {
        var_dump(2);
    }
}