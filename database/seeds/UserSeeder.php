<?php


class UserSeeder extends \Kernel\Abstracts\AbstractSeed
{
    public function run()
    {
		$this->faker();

		$user = new \App\Model\User();
		$user->first_name ='afshin';
		$user->last_name = 'akhgar';
		$user->password = \Kernel\Helpers\HashHelper::hash('123456');
		$user->username = 'afshin';
		$user->mobile = '09392131590';
		$user->email = 'afshin.akhgar@gmail.com';
		$user->api_token = md5(sha1(123456));
		$user->save();
	}
}
