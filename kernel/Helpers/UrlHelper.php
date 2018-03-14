<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:19 PM
 */

namespace Kernel\Helpers;


use Slim\Http\Request;

class UrlHelper
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
    public function get( $name, $params = array() )
    {
            $route = $this->container->get('router')->pathFor($name,$params);

            return $route;
    }


    public function getBasePath(Request $request)
    {
        $protocol = $request->getUri()->getScheme();
        $baseHost = $request->getUri()->getHost();
        $port = $request->getUri()->getPort() ? ':' . $request->getUri()->getPort() : '';
        $baseUrl = $protocol . '://' . $baseHost . $port;
        return $baseUrl;
    }

    public function getBaseRoutePath(Request $request)
    {
        $protocol = $request->getUri()->getScheme();
        $baseHost = $request->getUri()->getHost();
        $path = $request->getUri()->getPath();
        $pathArr = explode('/',$path);
        unset($pathArr[count($pathArr)-1]);
        $path = implode('/',$pathArr);
        $port = $request->getUri()->getPort() ? ':' . $request->getUri()->getPort() : '';
        $baseUrl = $protocol . '://' . $baseHost . $port . $path;
        return $baseUrl;
    }







}