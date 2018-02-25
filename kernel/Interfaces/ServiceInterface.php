<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 12:00 PM
 */

namespace Kernel\Interfaces;


interface ServiceInterface
{
    /**
     * Service register name
     */
    public function name();
    /**
     * Register new service on dependency container
     */
    public function register();
}