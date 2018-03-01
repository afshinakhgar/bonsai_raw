<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/28/18
 * Time: 11:20 PM
 */

namespace Kernel\Abstracts;


use Psr\Container\ContainerInterface;

abstract class AbstractContainer
{
    protected $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
    /**
     * Get Slim Container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }
    /**
     * Get Service From Container
     *
     * @param string $service
     * @return mixed
     */
    protected function getService($service)
    {
        return $this->container->{$service};
    }
    /**
     * Get Request
     *
     * @return Request
     */
    protected function getRequest()
    {
        return $this->container->request;
    }
    /**
     * Get Response
     *
     * @return Response
     */
    protected function getResponse()
    {
        return $this->container->response;
    }
    /**
     * Get Twig Engine
     *
     * @return Blade
     */
    protected function getView()
    {
        return $this->container->view;
    }
    /**
     * Render view
     *
     * @param string $template
     * @param array $data
     * @return ResponseInterface
     */
    protected function render($template, $data = [])
    {
        return $this->getView()->render($this->getResponse(), $template, $data);
    }
}