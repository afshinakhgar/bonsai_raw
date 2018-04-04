<?php

namespace Kernel\Services;


use Kernel\Abstracts\AbstractServices;
use Kernel\Traits\AuthTrait;

class AuthService extends AbstractServices
{
	use AuthTrait;
	public function loginByPassword($login_field,$password)
	{
		$auth =  $this->UserDataAccess->getUserLoginFieldWithPassword($login_field,$password);

		return $auth;
	}

	public function loginByApiToken($login_field,$token)
	{
		$auth =  $this->UserDataAccess->getUserLoginFieldWithToken($login_field,$token);

		return $auth;
	}



	public function user()
	{
		if(!isset($_SESSION['user']) && isset($_COOKIE['user']) &&  json_decode($_COOKIE['user'],true) !== null){
			$_SESSION['user'] = json_decode($_COOKIE['user'],true);
		}
		return $this->UserDataAccess->getUserById(isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0);
	}

	public function hasRole($roleName)
	{
		if(!self::check()){
			return false;
		}
		$userRoles =  $this->UserDataAccess->getUserRoles(isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0);
		$hasAccess = false;
		foreach ($userRoles as $role){
			if($role->name == $roleName){
				$hasAccess = true;
				break;
			}
		}
		return $hasAccess;
	}


	public function check()
	{
		if(!isset($_SESSION['user']) && isset($_COOKIE['user']) &&json_decode($_COOKIE['user'],true) !== null){
			$_SESSION['user'] = json_decode($_COOKIE['user'],true);
		}
		return isset($_SESSION['user']['user_id']);
	}


	public function register($inputObj)
	{
		return $this->createUser($inputObj);
	}


	public function login($inputObj){
        return $this->loginUser($inputObj);

    }
}
