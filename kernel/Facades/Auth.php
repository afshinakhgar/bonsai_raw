<?php
namespace Kernel\Facades;

use SlimFacades\Facade;
class Auth extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'Kernel_AuthService';
	}
}
