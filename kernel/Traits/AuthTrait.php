<?php

namespace Kernel\Traits;


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
		$authenticationModel->password =  $this->HashHelper->hash($password);

		$authenticationModel->username = $username;
		$authenticationModel->email = $email;
		$authenticationModel->mobile = $mobile;
		$authenticationModel->api_token = $api_token;
		$user = $this->UserDataAccess->createUser($authenticationModel);

		return $user;

	}

}
