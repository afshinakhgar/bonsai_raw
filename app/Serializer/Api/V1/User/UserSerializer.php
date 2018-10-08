<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/9/18
 * Time: 7:27 PM
 */

namespace App\Serializer\Api\V1\User;


use App\Serializer\Api\V1\Study\StudySerializer;
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






    public function study($data)
    {
//        dd($data->study->get());
        $dataRel = [];
        foreach($data->attendStudy as $row){
            $dataRel[] = (object)[
                'id'=> $row->id,
                'title'=>$row->title,
                'body'=>$row->body,
            ];
        }


        $element = new \Tobscure\JsonApi\Collection( $dataRel, new StudySerializer($this->container));



        return new Relationship($element);
    }

}
