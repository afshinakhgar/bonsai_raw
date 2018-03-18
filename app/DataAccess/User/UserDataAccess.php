<?php
namespace App\DataAccess\User;


use App\Model\User;
use Kernel\Abstracts\AbstractDataAccess;

/**
 * Class TestDataAccess
 * @package App\DataAccess
 */
class UserDataAccess extends AbstractDataAccess
{
	/**
	 * @param string $loginField
	 * @return mixed
	 */
	public function getUserLoginField(string $loginField)
	{
		return User::where('username', $loginField)
			->orWhere('email', $loginField)
			->orWhere('mobile', $loginField)
			->first();
	}


    public function getUserWithUsername(string $username)
    {
        return User::where('username', $username)
            ->first();
    }


	public function getUserLoginFieldWithToken(string $loginField , string $token)
	{
		return User::where('api_token',$token)
			->where('username', $loginField)
			->orWhere('email', $loginField)
			->orWhere('mobile', $loginField)
			->first();
	}

	public function getUserLoginFieldWithPassword(string $loginField , string $password)
	{
		return User::where('password',$password)
			->where('username', $loginField)
			->orWhere('email', $loginField)
			->orWhere('mobile', $loginField)
			->first();
	}



	public static function getUserById(int $userid)
	{
		return User::find((int)$userid);
	}


	public  function getUserRoles(int $userid)
	{

		$user = User::find((int)$userid);
		if(!$user){
			return false;
		}
		return User::find((int)$userid)->roles()->get();
	}


	public  function createUser($userObj)
	{
        $user = new User();
        $user->first_name = $userObj->first_name;
        $user->last_name = $userObj->last_name;
        $user->mobile = $userObj->mobile;
        $user->api_token = $userObj->api_token;
        $user->password = $userObj->password;
        $user->save();
	}
}
