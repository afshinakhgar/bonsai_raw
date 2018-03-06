<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 11:49 AM
 */

namespace App\MiddleWare;


use Kernel\Abstracts\AbstractMiddleWare;

class FlashMessageMiddleWare extends AbstractMiddleWare
{
    public function __invoke($request, $response, $next )
    {
//        $response->getBody()->write('BEFORE');
//
        $messages = $this->flash->getMessages();



//      Before App
//        $routeParams = $request->getAttribute('routeInfo')[2];




//        $parameters = explode('/',$routeParams['params']);
        $response = $next($request, $response);
//        $response->getBody()->write('AFTER');
//


        return $response;
    }
}