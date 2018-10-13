<?php

namespace App\Controller\Admin\User;
use App\Controller\_Controller;
use App\Model\Permission;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

class RoleController extends _Controller
{

    public function index(Request $request, Response $response, $args)
    {

        $limit     = 12; // Number of posts on one page
        $list = $this->RoleDataAccess->getAllRolesPaging($limit);


        $pagingData = $this->PagerHelper->pagingData($request,$list,$limit);


        return $this->view->render($response, 'admin.user.role.index',[
            'list'=>$list,
            'pagination'=>$pagingData
        ]);
    }

    public function create(Request $request, Response $response, $args)
    {

        return $this->view->render($response, 'admin.user.role.create');
    }
    public function store(Request $request, Response $response, $args)
    {
        $params = $request->getParams();

        $validate = $this->validator->validate($request,[
            'name' => v::notEmpty(),
            'display_name' => V::notEmpty(),
        ]);
        try{

            if($validate->isValid()){



                $createRole = $this->RoleDataAccess->createRole($params);

                if(!isset($createRole->id)){
                    $this->flash->addMessage('info','نقش ایجاد شد');
                    return $response->withRedirect('list');
                }else{
                    $this->flash->addMessage('error','نقش وجود دارد');

                    return $response->withRedirect('list');
                }

            }else{
                $this->flash->addMessage('error','اشکال در ورودی');
                return $response->withRedirect('list');
            }

        } catch (Exception $e) {
            // Generate Exception Error
        }
    }


    public function edit(Request $request, Response $response, $args)
    {
        $role = $this->RoleDataAccess->getRoleById($args['id']);

        $all_perms = Permission::all();
        $selected_perms = $role->permission()->get();

        foreach($selected_perms as $row){
            $selected_perm[$row->id] =  true;
        }

        return $this->view->render($response, 'admin.user.role.edit',[
            'role'=>$role,
            'all_perms'=>$all_perms,
            'selected_perms'=>$selected_perm,
        ]);
    }



    public function update(Request $request, Response $response, $args)
    {
        $validate = $this->validator->validate($request,[
            'name' => v::notEmpty(),
            'display_name' => V::notEmpty(),
        ]);

        $params = $request->getParams();

        if (!$validate->isValid()) {
            $this->flash->addMessage('error','ورودی مشکل دارد');
            return $response->withRedirect(route('admin.role.edit',['id'=>$args['id']]));
        }


        $this->RoleDataAccess->updateRole($params,$args['id']);


        $this->flash->addMessage('success','نقش ویرایش شد');
        return $response->withRedirect(route('admin.role.edit',['id'=>$args['id']]));
    }







    public function attach_perms(Request $request, Response $response, $args)
    {
//        $validate = $this->validator->validate($request,[
//            'id' => v::notEmpty(),
//        ]);

        $params = $request->getParams();
//
//        if (!$validate->isValid()) {
//            $this->flash->addMessage('error','ورودی مشکل دارد');
//            return $response->withRedirect(route('admin.role.edit',['id'=>$args['id']]));
//        }


        $perms = [];
        foreach($params['perm'] as $k=>$row){
            $perms[] = $k;
        }
        $this->RoleDataAccess->attach_perms_to_roles($perms,$args['id']);


        $this->flash->addMessage('success','دسترسی ها ویرایش شدند');
        return $response->withRedirect(route('admin.role.edit',['id'=>$args['id']]));
    }
}