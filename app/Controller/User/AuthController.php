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

            $data = $this->Kernel_RequestService->psr7Request(
                'http://localhost:8001/api/v1/user/auhtenticate/register',
                \GuzzleHttp\json_encode([
                    'firs_tname' => $request->getParam('first_name'),
                    'last_name' => $request->getParam('last_name'),
                    'mobile' => $request->getParam('mobile'),
                    'email' => $request->getParam('email'),
                ]),
                [
                    'username : ' . $request->getParam('username'),
                    'password : '. $request->getParam('password'),
                ]
            );
            dd($data);
            $this->flash->addMessage('info','You have been signed up');
//            return $response->withRedirect('/');


        }else{
            $this->flash->addMessage('error','Invalid Inputs');
//            return $response->withRedirect('/');
        }

    }


}