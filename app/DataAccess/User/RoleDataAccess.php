<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 12:20 AM
 */

namespace App\DataAccess\User;


use App\Model\Role;
use Kernel\Abstracts\AbstractDataAccess;

/**
 * @param UserDataAccess
 */

class RoleDataAccess extends AbstractDataAccess
{

    public  function getAllRolesPaging(int $limit = 20)
    {
        return Role::paginate($limit);
    }


    public  function listAllRoles()
    {
        return Role::all();
    }


    public  function getRoleById(int $role_id)
    {
        $role = Role::find($role_id);
//        $list = [];
//        if(isset($role->id)){
//            $list = $role->users()->get();
//        }
        return $role;
    }


    public  function createRole($params)
    {
        $role = new Role();
        $role->name = $params['name'];
        $role->display_name = $params['display_name'];
        $role->description = $params['description'] ? $params['description'] : '';

        $role->save();
    }

    public function updateRole($params,$id)
    {
        $role = Role::find($id);
        $role->name = $params['name'];
        $role->display_name = $params['display_name'];
        $role->description = $params['description'] ? $params['description'] : '';

        $role->save();
    }


}