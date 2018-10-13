<?php
namespace App\Middleware;

use App\Model\Role;
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

        $uri          = $request->getUri();
        $current_path = $uri->getPath();
        $route        = $request->getAttribute('route');
//        dd($route->getName());
//

        $roleObj = Role::where('name',$this->role)->first();
        $permsArr = [];
        foreach($roleObj->permission as $perm){
            $permsArr[$perm->name] = true;
        }


        if($this->role != 'admin'){
            if(!$permsArr[$route->getName()] ){
                return $response->withRedirect('/');
            }
        }




        if(!$role){
            return $response->withRedirect('/');
        }

        $response = $next($request, $response);


        return $response;
    }
}
