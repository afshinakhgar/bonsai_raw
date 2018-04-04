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
		$authenticationModel->password =  $password;

		$authenticationModel->username = $username;
		$authenticationModel->email = $email;
		$authenticationModel->mobile = $mobile;
		$authenticationModel->api_token = $api_token;
		$user = $this->UserDataAccess->createUser($authenticationModel);

		return $user;

	}



	public function login(string $loginField ,string $password)
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
			if ($this->checkPass($password,$user->password)) {

				$_SESSION['user']['user_id'] = $user->id;
				$_SESSION['user']['mobile'] = $user->mobile;
				$_SESSION['user']['username'] = $user->username;
				$_SESSION['user']['api_token'] = $user->api_token;

				setcookie('user', json_encode([
					'user_id'=>$user->id,
					'mobile'=>$user->mobile,
					'username'=>$user->username,
				]), time() + (86400 * 30), "/"); // 86400 = 1 day *30 => 30 day
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
		}
	}



	public function checkPass($password,$database_pass)
	{
		if($database_pass == $password){
			return true;
		}
		return false;

	}

}
