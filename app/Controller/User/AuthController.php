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

		$params = $request->getParams();
		$data = $this->Kernel_RequestService->post_apiCall(
			route('api.register',[],true),
			$params,
			[
				"cache-control: no-cache",
				'Content-Type: application/x-www-form-urlencoded',
				'username: '.$params['username'],
				'password: '.$params['password'],
			]
			);

		$dataa = json_decode($data,true);
		$errors = '';
		if(isset($dataa['error']['messages'])){
			$errors = $dataa['error']['messages'];
			$this->flash->addMessage('error',$errors);
		}else{

			var_dump($dataa['data'][0]['attributes']);exit;


			$this->flash->addMessage('info','You have been signed up');

		}


		return $response->withRedirect('/');


        if($this->validator->isValid()){


            if(!isset($userOne->id)){
                $user = new \stdClass();
                $hash = new HashHelper();
                $user->first_name = $request->getParam('firstname');
                $user->last_name = $request->getParam('lastname');
                $user->mobile = $request->getParam('mobile');
                $user->email = $request->getParam('email');
                $user->api_token = $hash->hash($request->getParam('username'));
                // not two step

                $user->password = $hash->hash($request->getParam('password'));
                $this->UserDataAccess->createUser($user);
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
