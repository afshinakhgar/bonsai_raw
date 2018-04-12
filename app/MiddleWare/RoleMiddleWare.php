<?php
namespace App\Middleware;

use Kernel\Abstracts\AbstractMiddleWare;
use Kernel\Facades\Auth;


class RoleMiddleWare extends AbstractMiddleWare
{



    private $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param callable                                 $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next  )
    {

        $role = Auth::hasRole($this->role);

        if(!$role){
            return $response->withRedirect('/');
        }

        $response = $next($request, $response);


        return $response;
    }
}
