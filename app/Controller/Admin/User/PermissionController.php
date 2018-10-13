<?php

namespace App\Controller\Admin\User;
use App\Controller\_Controller;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

class PermissionController extends _Controller
{

    public function index(Request $request, Response $response, $args)
    {

        $limit     = 12; // Number of posts on one page
        $list = $this->PermissionDataAccess->getAllPaginate($limit);


        $pagingData = $this->PagerHelper->pagingData($request,$list,$limit);


        return $this->view->render($response, 'admin.user.permission.index',[
            'list'=>$list,
            'pagination'=>$pagingData
        ]);
    }

    public function create(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'admin.user.permission.create');
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

                $stdObjPermission = new \stdClass();
                $stdObjPermission->name = $params['name'];
                $stdObjPermission->display_name = $params['display_name'];
                $stdObjPermission->description = $params['description'];

                $createRole = $this->PermissionDataAccess->create($stdObjPermission);

                if(!isset($createRole->id)){
                    $this->flash->addMessage('info','دسترسی ایجاد شد');
                    return $response->withRedirect('list');
                }else{
                    $this->flash->addMessage('error','دسترسی وجود دارد');

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
        $role = $this->PermissionDataAccess->getById($args['id']);
        return $this->view->render($response, 'admin.user.permission.edit',['role'=>$role]);
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
            return $response->withRedirect(route('admin.role.permission.edit',['id'=>$args['id']]));
        }



        $this->PermissionDataAccess->update($params,$args['id']);


        $this->flash->addMessage('success','نقش ویرایش شد');
        return $response->withRedirect(route('admin.role.permission.edit',['id'=>$args['id']]));
    }


}