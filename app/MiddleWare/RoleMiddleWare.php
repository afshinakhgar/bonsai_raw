<?php
namespace App\MiddleWare;

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
        if(!isset($this->role)){
            return $response->withRedirect('/');

        }
        $permsArrNames = [];

        $role = Auth::hasRole($this->role);

        $uri          = $request->getUri();
        $current_path = $uri->getPath();
        $route        = $request->getAttribute('route');
//        dd($route->getName());
//

        $roleObj = Role::where('name',$this->role)->first();
        $permsArr = [];

//        $routesAll = $GLOBALS['container']->get('router')->getRoutes();
//        foreach($GLOBALS['container']->router->getRoutes() as $routeRow){
//            foreach($route->getMethods() as $methods){
//                dd($route->getName());
//
//
//            }
//
//        }
//
        foreach($roleObj->permission as $perm){
            $permsArr[$perm->name] = true;
            $permsArrNames[] = $perm->name;
        }

        $path_url = trim($current_path,'/');


        $needPermission = false;
        if(in_array($path_url,$permsArrNames)){
            $needPermission = true ;
        }

        if( in_array($route->getName(),$permsArrNames)){
            $needPermission = true ;
        }
        $haveAccess = false;
        if($needPermission){
            if($permsArr[$route->getName()] ){
                $haveAccess = true;
//                return $response->withRedirect('/');
            }

        }


        if(!$haveAccess && !$role){
            return $response->withRedirect('/');
        }



        if(!$role){
            return $response->withRedirect('/');
        }

        $response = $next($request, $response);


        return $response;
    }




    function permit($route)
    {


    }
}
