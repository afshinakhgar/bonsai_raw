<?php
namespace App\MiddleWare;

use Kernel\Abstracts\AbstractMiddleWare;

class UserOwnerMiddleWare extends AbstractMiddleWare
{

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param callable                                 $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next )
    {

        $uri          = $request->getUri();
        $current_path = $uri->getPath();
        $partUrl = explode('/', trim($current_path,'/'));
        
        

       $routeParams = $request->getAttribute('routeInfo')[2];


        if(!Auth::user()->id && !Auth::user()->id != $routeParams['id']){
            return $response->withRedirect('/login');
        }

        $response = $next($request, $response);


        return $response;
    }
}
