<?php
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