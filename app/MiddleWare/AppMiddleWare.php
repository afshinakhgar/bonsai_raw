<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 3:35 PM
 */

namespace App\MiddleWare;


use Kernel\Abstracts\AbstractMiddleWare;

class AppMiddleWare extends AbstractMiddleWare
{
    public function __invoke($request, $response, $next )
    {
//        $response->getBody()->write('BEFORE');

        $response = $next($request, $response);

//        $response->getBody()->write('AFTER');
        return $response;
    }
}