<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/9/18
 * Time: 7:27 PM
 */

namespace App\Serializer\Api\V1\User;


use Kernel\JsonApi\JsonApiSerializer;
use Tobscure\JsonApi\Relationship;

class UserSerializer extends JsonApiSerializer
{
	protected $type = 'user';


	public function __construct($container) {
		$this->container = $container;

		$this->model= [
			'first_name' ,
			'last_name' ,
			'email' ,
			'mobile',
			'username',
		];
	}

	public function getAttributes($user, array $fields = null)
	{
		return [
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'email' => $user->email,
			'mobile' => $user->mobile,
			'username' => $user->username,
//			'api_token' => $user->api_token,
		];
	}

	public function getId($user)
	{
		return $user->id;
	}






}
