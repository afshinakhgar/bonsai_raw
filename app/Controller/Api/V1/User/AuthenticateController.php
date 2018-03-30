<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/9/18
 * Time: 4:33 PM
 */

namespace App\Controller\Api\V1\User;


use App\Controller\_Controller;
use App\Serializer\Api\V1\User\AuthenticateSerializer;
use Illuminate\Support\Facades\Hash;
use Kernel\Facades\Auth;
use Kernel\Helpers\HashHelper;
use Kernel\JsonApi\Exceptions\GeneralException;
use Slim\Http\Request;
use Slim\Http\Response;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Document;
use Respect\Validation\Validator as v;

class AuthenticateController extends _Controller
{
	/**
	 * get
	 * @param Request $request
	 * @param Response $response
	 * @param $args
	 */
	public function login(Request $request , Response $response , $args)
	{
		try {
			$loginField = $request->getHeader('login')[0];
			$token = $request->getHeader('token')[0];

			if(!$token){
				$password = $request->getHeader('password')[0];
			}else{
				$user = Auth::loginByApiToken($loginField,$token);

			}


			if(!$user){
				$user = Auth::loginByPassword($loginField,HashHelper::hash($password));
			}
//            $this->validator->addError('username', 'User already exists with this username.');


			if($user){
				$user = $user->get();
			}

			if (!$this->validator->isValid()) {
				return $this->badRequest($response, $this->validator->getErrors());
			}



			$collection = (new Collection($user, new AuthenticateSerializer($this->container)));
			$document = new Document($collection);
			$response = $response->withStatus(200);
			return $response->withJson($document);
		} catch (GeneralException $e) {
			return $this->catchErrorHandler( $response,$e);
		}

	}

    public function register(Request $request , Response $response , $args)
    {
		try {
            $this->validator->validate($request,[
                'email' => v::noWhitespace()->notEmpty(),
                'mobile' => v::noWhitespace()->notEmpty(),
            ]);

            $username = $request->getHeader('username')[0].rand(1,9999);
            $password = $request->getHeader('password')[0];
            $repass = $request->getHeader('repass');
            $email = $request->getParam('email').rand(1,9999);
            $mobile = $request->getParam('mobile').rand(1,9999);
            $first_name = $request->getParam('first_name') ?? '';
            $last_name = $request->getParam('first_name') ?? '';


            $usernameExistsCheck = $this->UserDataAccess->getUserWithUsername($username);
            $emailExistsCheck = $this->UserDataAccess->getUserLoginField($email);
            $mobileExistsCheck = $this->UserDataAccess->getUserLoginField($mobile);

			$api_token = $this->HashHelper->hash($username.$email.$password);


			if(isset($usernameExistsCheck->id) || isset($emailExistsCheck->id) || isset($mobileExistsCheck->id)){
                return $this->badRequest($response, [
                    'message'=>[
                        'userexists'=>'user email | username | mobile is exists',
                    ],
                ]);
            }

            if (!$this->validator->isValid()) {
                return $this->badRequest($response, $this->validator->getErrors());
            }

            $authenticationModel = new \stdClass();
            $authenticationModel->first_name = $first_name;
            $authenticationModel->id = '';
            $authenticationModel->last_name = $last_name;
            $authenticationModel->password =  $this->HashHelper->hash($password);

            $authenticationModel->username = $username;
            $authenticationModel->email = $email;
            $authenticationModel->mobile = $mobile;
            $authenticationModel->api_token = $api_token;
            $user = $this->UserDataAccess->createUser($authenticationModel);


            $userModel[] = $user;
			$collection = (new Collection($userModel, new AuthenticateSerializer($this->container)));
            $document = new Document($collection);


            $response = $response->withStatus(200);
            return $response->withJson($document);
        } catch (GeneralException $e) {
            return $this->catchErrorHandler( $response,$e);
        }
    }

}
