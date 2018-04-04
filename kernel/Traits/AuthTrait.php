<?php

namespace Kernel\Traits;


use Kernel\Facades\Auth;

trait AuthTrait
{
	function createUser($authenticationModel){


		$username = $authenticationModel->username;
		$passwordRaw = $authenticationModel->password;
		$api_token = $this->HashHelper->hash($username.$passwordRaw);

		$password =  $this->HashHelper->hash($passwordRaw);

		$repass = $authenticationModel->repass;

		$email = $authenticationModel->email;
		$mobile = $authenticationModel->mobile;
		$first_name = $authenticationModel->first_name;
		$last_name = $authenticationModel->last_name;

		$usernameExistsCheck = $this->UserDataAccess->getUserWithUsername($username);
		$emailExistsCheck = $this->UserDataAccess->getUserLoginField($email);
		$mobileExistsCheck = $this->UserDataAccess->getUserLoginField($mobile);
		if($repass != $passwordRaw){
			$errorMessage = [
				'data' => [
					'type' => 'error',
					'messages'=> [
						'passwordMatch'=>'Password Doesn\'t match!',
					],
				]
			];
		}

		if(isset($usernameExistsCheck->id) || isset($emailExistsCheck->id) || isset($mobileExistsCheck->id)){
			$errorMessage = [
				'data' => [
					'type' => 'error',
					'messages'=> [
						'user_exists'=>'user email | username | mobile is exists',
					],
				]
			];
		}



		if(isset($errorMessage)){
			return $errorMessage;
		}

		$authenticationModel->first_name = $first_name;
		$authenticationModel->id = '';
		$authenticationModel->last_name = $last_name;
		$authenticationModel->password =  $password;

		$authenticationModel->username = $username;
		$authenticationModel->email = $email;
		$authenticationModel->mobile = $mobile;
		$authenticationModel->api_token = $api_token;
		$user = $this->UserDataAccess->createUser($authenticationModel);

		return $user;

	}



	public function login(string $loginField ,string $password , $type = 'basic')
	{
		$user = $this->UserDataAccess->getUserLoginField($loginField);
		if (!$user) {
			return [
				'data' => [
					'type'=>'error',
					'message'=> 'User Not Exists',
				]
			];
		}else {
		    if($type == 'basic'){
                if ($this->checkPass($password,$user->password)) {


                    return [
                        'data' => [
                            'type'=>'success',
                            'message'=> 'وارد شدید',
                        ]
                    ];
                } else {
                    return [
                        'data' => [
                            'type'=>'error',
                            'message'=> 'password mismatch',
                        ]
                    ];
                }
            } else if($type == 'token'){
                $user = Auth::loginByApiToken($loginField,$password);

                if($user->id){

                    return [
                        'data' => [
                            'type'=>'success',
                            'message'=> 'وارد شدید',
                        ]
                    ];
                }else{
                    return [
                        'data' => [
                            'type'=>'error',
                            'message'=> 'password mismatch',
                        ]
                    ];
                }


            }

            return $user;

		}


        return null;
	}



	public function checkPass($password,$database_pass)
	{
		if($database_pass == $password){
			return true;
		}
		return false;

	}

}
