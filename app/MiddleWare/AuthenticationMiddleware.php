<?php
namespace App\MiddleWare;

use Kernel\Facades\Auth;

use Kernel\Abstracts\AbstractMiddleWare;

class AuthenticationMiddleware extends AbstractMiddleWare
{

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param callable                                 $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next )
    {
        if(!Auth::check()){
            return $response->withRedirect('/login');
        }

        $response = $next($request, $response);


        return $response;
    }
}
