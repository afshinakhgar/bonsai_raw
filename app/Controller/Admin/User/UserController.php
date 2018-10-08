<?php

namespace App\Controller\Admin\User;
use App\Controller\_Controller;
use App\Model\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Kernel\Helpers\HashHelper;
use Kernel\Helpers\PagerHelper;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

class UserController extends _Controller
{

    public function index(Request $request, Response $response, $args)
    {
        $limit     = 12; // Number of posts on one page
        $list = $this->UserDataAccess->getAllUsersPaging($limit);


        $pagingData = $this->PagerHelper->pagingData($request,$list,$limit);
        return $this->view->render($response, 'admin.user.index',[
            'list'=>$list,
            'pagination'=>$pagingData
        ]);
    }
    public function create(Request $request, Response $response, $args)
    {
        $allRolesList = $this->_getAllRoles();
        return $this->view->render($response, 'admin.user.create',['roles'=>$allRolesList]);
    }


    public function store(Request $request, Response $response, $args)
    {
        $params = $request->getParams();
        foreach($params as $key=>$param){
            $fields[$key] = $param;
        }

        unset($fields['roles']);
        $hash = new HashHelper();
        $fields['password'] = $hash->hash($fields['password']);



        $user = $this->UserDataAccess->createUsersByFields($fields);
        $attachedRoles = explode(',', trim($params['roles'],','));
        // $attachRolesToUsers =
        if($attachedRoles){
            $user->roles()->sync($attachedRoles);
            $user->save();
        }

//        $uploadedFiles = $request->getUploadedFiles();
//        if($uploadedFiles){
//            $uploadedFile = $uploadedFiles['file'];
//            if($uploadedFile->getSize()){
//                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
//                    $directory = $this->settings['app']['image']['dir'].'/temp';
//                    if(!is_dir($directory)){
//                        @mkdir($directory);
//                    }
//                    $file = File::moveUploadedFile($directory,$user->id, $uploadedFile);
//                    Image::createPhotos($directory.'/'.$file,$user->id);
//                    if(file_exists($file)){
//                        File::delete($file);
//                    }
//
//
//                if($user->has_pic == 'no'){
//                    UserDataAccess::updateuserFieldById($user,['has_pic'=>'yes']);
//                }
//            }
//        }

        $this->flash->addMessage('success','کاربر جدید ایجاد شد');

        return $response->withRedirect(Route('admin.user.list'));
    }


    public function edit(Request $request, Response $response, $args)
    {
        $user = $this->UserDataAccess->getuserbyid($args['id']);
        if(!$user->id){
            $user = $this->UserDataAccess->getUserOneByUsername($args['username']);
        }
        $allRolesList = $this->_getAllRoles();
        $user_roleList = $this->UserDataAccess->getUserRoles($user->id);
        $roleList = '';
        foreach($user_roleList as $roles){
            $roleList .= $roles->id.',';
        }
        $current_roleList = trim($roleList,',');
        if(!$user){
            return '404';
        }
        return $this->view->render($response, 'admin.user.edit',[
            'user'=>$user,
            'roles'=>$allRolesList,
            'user_roleList' => $user_roleList,
            'current_roles_id' => $current_roleList
        ]);
    }



    public function update(Request $request, Response $response, $args)
    {
        $params = $request->getParams();
        $user = $this->UserDataAccess->getUserById($args['id']);


        $validate = $this->validator->validate($request,[
            'username' => v::noWhitespace()->notEmpty()
        ]);

        $params = $request->getParams();

        if (!$validate->isValid()) {
            $this->flash->addMessage('error','ورودی مشکل دارد');
            $userField = $args['id'] ? $args['id'] : $params['mobile'];
            return $response->withRedirect(route('admin.user.edit',['id'=>$userField]));
        }
        foreach($params as $key=>$param){
            $fields[$key] = $param;
        }
        unset($fields['roles']);

        $this->UserDataAccess->updateuserFieldById($user,$fields);

        $newRoles = (trim(str_replace('0','',trim($params['roles'],',')),','));
        $attachedRoles = explode(',', $newRoles);

        if(count($attachedRoles) == 1 && $attachedRoles[0] == ''){
            unset($attachedRoles[0]);
            $attachedRoles = [];
        }
        // $attachRolesToUsers =
        $user->roles()->sync($attachedRoles);
        $user->save();


        $this->flash->addMessage('success','کاربر ویرایش شد');
        $userField = $args['id'] ? $args['id'] : $params['id'];
        return $response->withRedirect(route('admin.user.edit',['id'=>$userField]));
    }



    public function profile(Request $request , Response $response , $args)
    {
            $user = $this->UserDataAccess->getUserWithUsername($args['username']);

            return $this->view->render($response, 'admin.user.profile',[
                'user'=>$user,
            ]);

        }



    public function delete(Request $request,Response $response , $args)
    {
        $user = User::find($args['id']);
        $admin = false;

        if($user){
            $roles = $user->roles()->get();


            foreach($roles as $row){
                if($row->name == 'admin'){
                    $admin = true;
                    break;
                }
            }
        }

        if($admin){
            $this->flash->addMessage('error','این کاربر قابل حذف نیست');
            return $response->withRedirect(route('admin.user.list'));

        }

        User::destroy($args['id']);



        $this->flash->addMessage('success','کاربر حذف شد');
        return $response->withRedirect(route('admin.user.list'));

    }

    private function _getAllRoles()
    {
        $all_roles = $this->RoleDataAccess->listAllRoles();
        foreach($all_roles as $role){
            $allRolesList[$role->id] = $role->display_name;
        }

        return $allRolesList;
    }

}