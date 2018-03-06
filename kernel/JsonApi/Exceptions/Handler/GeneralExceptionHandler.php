<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/7/18
 * Time: 12:04 AM
 */

namespace Kernel\JsonApi\Exceptions\Handler;


use Kernel\JsonApi\Exceptions\GeneralException;
use Tobscure\JsonApi\Exception\Handler\ExceptionHandlerInterface;
use Exception;
use Tobscure\JsonApi\Exception\Handler\ResponseBag;

class GeneralExceptionHandler implements ExceptionHandlerInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function manages(Exception $e)
	{
		return $e instanceof GeneralException;
	}

	/**
	 * {@inheritdoc}
	 */
	public function handle(Exception $e)
	{
		$status = 400;
		$error = [];

		$code = $e->getCode();
		if ($code) {
			$error['code'] = $code;
		}

		$message = $e->getMessage();
		if ($message)
		{
			$error['message'] = $message;
		}

		$invalidParameter = $e->getInvalidParameter();
		if ($invalidParameter) {
			$error['source'] = ['parameter' => $invalidParameter];
		}

		return new ResponseBag($status, [$error]);
	}
}
