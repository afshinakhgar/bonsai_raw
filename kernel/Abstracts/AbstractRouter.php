<?php
namespace Kernel\Abstracts;
use Psr\Container\ContainerInterface;
use Kernel\Helpers\DirectoryHelper;
use Slim\Route;

/**
 * Class AbstractRouter
 */
abstract class AbstractRouter
{
    protected $app;

    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get Slim Container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->app->container;
    }




    public function partialRouterLoader($filesAddressFolder)
    {
        $direcoryHelperObj = new DirectoryHelper();
        $route = $this;
        $app = $this->app;
        $files = $direcoryHelperObj->scan($filesAddressFolder);
        /** Route Partial Loadup =================================================== */
        foreach ($files as $partial) {
            $file = $filesAddressFolder.$partial;
            $filse[] = $file;
            if ( ! file_exists($file))
            {
                $msg = "Route partial [{$partial}] not found.";
            }
            include $file;
        }
    }

}