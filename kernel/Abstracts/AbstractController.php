<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 11:58 AM
 */

namespace Kernel\Abstracts;



use Kernel\Handlers\ErrorHandler;
use Kernel\JsonApi\Exceptions\Handler\GeneralExceptionHandler;
use Exception;
use Slim\Http\Response;
use Tobscure\JsonApi\Document;

abstract class AbstractController extends AbstractContainer
{
    public function catchErrorHandler(Response $response, Exception $e)
    {

        $code = $e->getCode();
        if(!is_numeric($code) || $code == 0 || $code > 599 || $code < 200) {
            $code = 500;
        }

        $errors = new \Tobscure\JsonApi\ErrorHandler();
        $errors->registerHandler(new GeneralExceptionHandler());
        $response_err = $errors->handle($e);
        $document = new Document();
        $document->setErrors($response_err->getErrors());
        $response = $response->withStatus($code);

//        $logErrors = [
//            "Slim\Exception\ContainerValueNotFoundException",
//            "Slim\Exception\ContainerException",
//            "Slim\Exception\NotFoundException",
//            "Slim\Exception\ContainerException"
//        ];
//        $className = get_class($e);
//        $parentClassName = get_parent_class($e);
//        if (in_array($className,$logErrors) || $parentClassName =="RuntimeException"){
//            $this->logger->error($e);
//        }

        return $response->withJson($document);
    }
}