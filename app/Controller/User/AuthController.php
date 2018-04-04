<?php

namespace App\Controller\User;
use App\Controller\_Controller;
use App\Model\User;
use Kernel\Facades\Auth;
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
        if($this->validator->isValid()){


            $user = new \stdClass();
            $user->first_name = $request->getParam('first_name');
            $user->last_name = $request->getParam('last_name');
            $user->mobile = $request->getParam('mobile');
            $user->email = $request->getParam('email');
            $user->password = $request->getParam('password');
            $user->repass = $request->getParam('repass');
            $user->username = $request->getParam('username');
            // not two step

            $userData = Auth::register($user);
            if(is_array($userData)  && $userData['data']['type'] == 'error'){
                $this->flash->addMessage('error','Signup Problem');
                return $response->withRedirect('/user/register');
            }

            $this->flash->addMessage('info','You have been signed up');
            return $response->withRedirect('/user/register');


        }else{
            $this->flash->addMessage('error','Invalid Inputs');
            return $response->withRedirect('/');
        }
	}



	public function get_login(Request $request , Response $response , $args)
	{
//		if(Auth::check()){
//			return $response->withRedirect('/');
//		}
		return $this->view->render($response, 'auth.login');

	}


	public function post_login(Request $request , Response $response , $args)
	{




        $_SESSION['user']['user_id'] = $user->id;
        $_SESSION['user']['mobile'] = $user->mobile;
        $_SESSION['user']['username'] = $user->username;
        $_SESSION['user']['api_token'] = $user->api_token;

        setcookie('user', json_encode([
            'user_id'=>$user->id,
            'mobile'=>$user->mobile,
            'username'=>$user->username,
        ]), time() + (86400 * 30), "/"); // 86400 = 1 day *30 => 30 day


		return $this->view->render($response, 'auth.login');

	}


//    public function post_create(Request $request , Response $response , $args )
//    {
//
//		$params = $request->getParams();
//		$data = $this->Kernel_RequestService->post_apiCall(
//			route('api.register',[],true),
//			$params,
//			[
//				"cache-control: no-cache",
//				'username: '.$params['username'],
//				'password: '.$params['password'],
//			]
//			);
//		dd($data);
//		$dataa = json_decode($data,true);
//		$errors = '';
//		if(isset($dataa['error']['messages'])){
//			$errors = $dataa['error']['messages'];
//			$this->flash->addMessage('error',$errors);
//		}else{
//
//			dd($dataa);
//
//
//			$this->flash->addMessage('info','You have been signed up');
//
//		}
//
//
//		return $response->withRedirect('/');
//
//
//        if($this->validator->isValid()){
//
//
//            if(!isset($userOne->id)){
//                $user = new \stdClass();
//                $hash = new HashHelper();
//                $user->first_name = $request->getParam('firstname');
//                $user->last_name = $request->getParam('lastname');
//                $user->mobile = $request->getParam('mobile');
//                $user->email = $request->getParam('email');
//                $user->api_token = $hash->hash($request->getParam('username'));
//                // not two step
//
//                $user->password = $hash->hash($request->getParam('password'));
//                $this->UserDataAccess->createUser($user);
//                $this->flash->addMessage('info','You have been signed up');
//                return $response->withRedirect('/');
//            }else{
//                $this->flash->addMessage('error','User Already exist');
//
//                return $response->withRedirect('/');
//            }
//
//        }else{
//            $this->flash->addMessage('error','Invalid Inputs');
//            return $response->withRedirect('/');
//        }
//
//    }


}
