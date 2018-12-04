<?php
namespace Kernel\Facades;

use SlimFacades\Facade;
class Sms extends Facade
{
    /**
     * @return
    */
    protected static function getFacadeAccessor()
    {
        return 'Kernel_SmsService';
    }
}
