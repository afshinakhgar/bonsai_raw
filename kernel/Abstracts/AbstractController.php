<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 11:58 AM
 */

namespace Kernel\Abstracts;


use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class AbstractController
{
    /**
     * Slim Container
     *
     * @var ContainerInterface
     */
    protected $container;
    /**
     * Controller constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        unset($container);
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
     * Get Template Engine
     *
     * @return Template
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
     * @return string
     */
    protected function render($template, $data = [])
    {
        return $this->getView()->render($this->getResponse(), $template, $data);
    }
}