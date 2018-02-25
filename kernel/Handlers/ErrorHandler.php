<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 11:54 AM
 */

namespace Kernel\Handlers;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;
use Slim\Handlers\Error;

class ErrorHandler extends Error
{

    /**
     * Logger Instance
     *
     * @var object
     */
    protected $logger;
    /**
     * ErrorHandler constructor
     *
     * @param object $logger
     */
    public function __construct($logger)
    {
        $this->logger = $logger;
        unset($logger);
        parent::__construct(env('APP_DEBUG', false));
    }
    /**
     * Invoke error handler
     *
     * @param ServerRequestInterface $request   The most recent Request object
     * @param ResponseInterface      $response  The most recent Response object
     * @param \Exception             $exception The caught Exception object
     *
     * @return ResponseInterface
     * @throws UnexpectedValueException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, \Exception $exception)
    {
        // Log Critical Message //
        $this->logger->critical($exception->getMessage());
        return parent::__invoke($request, $response, $exception);
    }
}