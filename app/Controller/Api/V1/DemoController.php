<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 12:04 PM
 */

namespace App\Controller\Api\V1;


use App\Controller\_Controller;
use App\Model\Demo;
use App\Serializer\Demo\DemoSerializer;
use Kernel\JsonApi\Exceptions\GeneralException;
use Kernel\JsonApi\Exceptions\Handler\GeneralExceptionHandler;
use Slim\Http\Request;
use Slim\Http\Response;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\ErrorHandler;
use Tobscure\JsonApi\Exception\Handler\FallbackExceptionHandler;
use Tobscure\JsonApi\Exception\Handler\InvalidParameterExceptionHandler;

/**
 * Class DemoController
 * @package App\Controller\Api\V1
 */
class DemoController extends _Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function index(Request $request , Response $response , array $args)
    {

        try {
            $dataAccess = $this->DemoDataAccess->getOne(1);
            $collection = (new Collection($dataAccess['item'], new DemoSerializer($this->container)));
            $document = new Document($collection);
            $response = $response->withStatus(200);
            return $response->withJson($document);
        } catch (GeneralException $e) {
			$exp = new GeneralExceptionHandler($e);
			$exp->handle($e);
        }


//        try {
////            $dataAccess = Demo::find(1)->get();
//            $dataAccess['items'] = $this->TestDataAccess->getOne(1);
//
//
//            $collection = (new Collection($dataAccess, new DemoSerializer($this->container)));
//            $document = new Document($collection);
//            $document->addLink('aa', 'http://example.com/api/posts');
//            echo json_encode($document);
//        } catch (\Exception $e) {
//            $errors = new ErrorHandler();
//
//            $errors->registerHandler(new InvalidParameterExceptionHandler());
//            $errors->registerHandler(new FallbackExceptionHandler());
//
//            $response = $errors->handle($e);
//
//            $document = new Document;
//            $document->setErrors($response->getErrors());
//
//            return new JsonResponse($document, $response->getStatus());
//        }



//        $this->render('admin.index',['name'=>'afshin']);
    }
}
