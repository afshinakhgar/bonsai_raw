<?php
namespace Kernel\Facades;
use SlimFacades\Facade;
class File extends Facade
{
    /**
     * @return AuthService
     *
     */
    protected static function getFacadeAccessor()
    {
        return 'Kernel_FileService';
    }
}
