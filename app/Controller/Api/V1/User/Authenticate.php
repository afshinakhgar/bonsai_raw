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
use Kernel\Facades\Auth;
use Kernel\JsonApi\Exceptions\GeneralException;
use Slim\Http\Request;
use Slim\Http\Response;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Document;

class Authenticate extends _Controller
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
			$user = Auth::loginByApiToken($loginField,$token)->get();
//            $this->validator->addError('username', 'User already exists with this username.');

			if (!$this->validator->isValid()) {
				return $this->badRequest($response, $this->validator->getErrors());

				throw new GeneralException('error',400);
			}



			$collection = (new Collection($user, new AuthenticateSerializer($this->container)));
			$document = new Document($collection);
			$response = $response->withStatus(200);
			return $response->withJson($document);
		} catch (GeneralException $e) {
			return $this->catchErrorHandler( $response,$e);
		}

	}


}
