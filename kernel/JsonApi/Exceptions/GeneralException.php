<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/7/18
 * Time: 12:00 AM
 */

namespace Kernel\JsonApi\Exceptions;

use Exception;

class GeneralException extends Exception
{
	/**
	 * @var string The parameter that caused this exception.
	 */
	private $invalidParameter;

	/**
	 * {@inheritdoc}
	 *
	 * @param string $invalidParameter The parameter that caused this exception.
	 */
	public function __construct($message = '', $code = 0, $previous = null, $invalidParameter = '')
	{
		parent::__construct($message, $code, $previous);

		$this->invalidParameter = $invalidParameter;
	}

	/**
	 * @return string The parameter that caused this exception.
	 */
	public function getInvalidParameter()
	{
		return $this->invalidParameter;
	}
}
