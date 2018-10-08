<?php
namespace Kernel\Facades;

use SlimFacades\Facade;
class Image extends Facade
{
    /**
     * @return
    */
    protected static function getFacadeAccessor()
    {
        return 'Kernel_ImageService';
    }
}
