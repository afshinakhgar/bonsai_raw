<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 2:29 PM
 */

namespace Kernel\Abstracts;


class AbstractMiddleWare
{
    protected $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
}