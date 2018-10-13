<?php
namespace App\DataAccess\User;


use App\Model\Permission;
use App\Model\Role;
use App\Model\User;
use Kernel\Abstracts\AbstractDataAccess;

/**
 * Class PermissionDataAccess
 * @package App\DataAccess
 */
class PermissionDataAccess extends AbstractDataAccess
{
	/**
	 * @param string $loginField
	 * @return mixed
	 */
	public function getAllPaginate(string $loginField)
	{
		return Permission::paginate(20);
	}

    public  function create($obj)
    {
        $perm = new Permission();
        $perm->name = $obj->name;
        $perm->display_name = $obj->display_name;
        $perm->description = $obj->description;

        $perm->save();
    }


    public function getById(int $id)
    {
        return Permission::find($id);
    }



    public function update($params,$id)
    {
        $perm = Permission::find($id);
        $perm->name = $params['name'];
        $perm->display_name = $params['display_name'];
        $perm->description = $params['description'] ? $params['description'] : '';

        $perm->save();
    }



//
//	public function getUserLoginFieldWithToken(string $loginField , string $token)
//	{
//		return User::where('api_token',$token)
//			->where('username', $loginField)
//			->orWhere('email', $loginField)
//			->orWhere('mobile', $loginField)
//			->first();
//	}
//
//	public function getUserLoginFieldWithPassword(string $loginField , string $password)
//	{
//		return User::where('password',$password)
//			->where('username', $loginField)
//			->orWhere('email', $loginField)
//			->orWhere('mobile', $loginField)
//			->first();
//	}
//
//
//
//	public static function getUserById(int $userid)
//	{
//		return User::find((int)$userid,['id','first_name','last_name','username','mobile','email']);
//	}
//
//
//	public  function getUserRoles(int $userid)
//	{
//
//		$user = User::find((int)$userid);
//		if(!$user){
//			return false;
//		}
//		return User::find((int)$userid)->roles()->get();
//	}
//
//

//
//
//    public  function createUsersByFields(array $fields)
//    {
//
//        $user = new User;
//        foreach($fields as $field=>$value){
//            $user->$field = $value;
//        }
//
//        $user->save();
//
//        return $user;
//    }
//
//
//
//    public  function updateuserFieldById($user,array $fields)
//    {
//        foreach($fields as $field=>$value){
//            $user->$field = $value;
//        }
//        $user->save();
//
//
//        return $user;
//    }
//
//    public  function attendStudy($user,array $data)
//    {
//        $user->attendStudy()->sync($data);
//        $user->save();
//        return $user;
//    }
//    public  function attendExam($user,array $data)
//    {
//        $user->attendExam()->attach($data);
//        $user->save();
//        return $user;
//    }
}
