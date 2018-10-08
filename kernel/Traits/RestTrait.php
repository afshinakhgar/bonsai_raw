<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/7/18
 * Time: 4:35 PM
 */

namespace Kernel\Traits;


use Slim\Http\Response;

trait RestTrait
{


    /**
     * Returns a "201 Created" response with a location header.
     *
     * @param Response $response
     * @param string   $route
     * @param array    $params
     *
     * @return Response
     */

    protected function badRequest(Response $response, $data , $code = 400)
    {
        $data_error['error'] = $data;
        $data_error['code'] = $code;
        return $response->withJson($data_error, $code);

    }


    /**
     * Returns a "204 No Content" response.
     *
     * @param Response $response
     *
     * @return Response
     */
    protected function noContent(Response $response)
    {
        return $response->withStatus(204);
    }
}