<?php

namespace App\Controller\User;
use App\Controller\_Controller;
use App\Model\User;
use Kernel\Helpers\HashHelper;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

class AuthController extends _Controller
{
    public function get_create(Request $request , Response $response )
    {
        return $this->view->render($response, 'auth.register');
    }


    public function post_create(Request $request , Response $response , $args )
    {
//        $a = $this->Kernel_RequestService->post_apiCall(route('api.register'));

        $this->validator->validate($request,[
            'username' => v::noWhitespace()->notEmpty(),
        ]);
        if (!$this->validator->isValid()) {
            $this->flash->addMessage('200',$this->validator->getErrors());

            return $response->withRedirect('/');
        }
        if($this->validator->isValid()){

            $params = $request->getParams();
            $userOne = $this->UserDataAccess->getUserLoginField($params['email']);

            if(!isset($userOne->id)){
                $user = new User();
                $hash = new HashHelper();
                $user->first_name = $request->getParam('firstname');
                $user->last_name = $request->getParam('lastname');
                $user->mobile = $request->getParam('username');
                $user->api_token = $hash->hash($request->getParam('username'));
                // not two step

                $user->password = $hash->hash($request->getParam('password'));

                $user->save();
                $this->flash->addMessage('info','You have been signed up');
                return $response->withRedirect('/');
            }else{
                $this->flash->addMessage('error','User Already exist');

                return $response->withRedirect('/');
            }

        }else{
            $this->flash->addMessage('error','Invalid Inputs');
            return $response->withRedirect('/');
        }

    }

}