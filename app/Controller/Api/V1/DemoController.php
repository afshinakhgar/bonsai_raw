<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 12:04 PM
 */

namespace App\Controller\Api\V1;


use App\Controller\_Controller;
use App\Serializer\Demo\DemoSerializer;
use Kernel\JsonApi\Exceptions\GeneralException;
use Slim\Http\Request;
use Slim\Http\Response;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\Collection;
use Respect\Validation\Validator as V;

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
            $this->validator->request($request, [
                'name' => V::length(3, 25)->alnum('_')->noWhitespace(),
                'password' => [
                    'rules' => V::noWhitespace()->length(6, 25),
                    'messages' => [
                        'length' => 'The password length must be between {{minValue}} and {{maxValue}} characters'
                    ]
                ]
            ]);

//            $this->validator->addError('username', 'User already exists with this username.');

            if (!$this->validator->isValid()) {
//                return $this->badRequest($response, $this->validator->getErrors());

                throw new GeneralException('error',400);
            }

            $dataAccess = $this->DemoDataAccess->getAll();
            if(!$dataAccess){
                throw new GeneralException('asdasds',404);
            }

            $collection = (new Collection($dataAccess, new DemoSerializer($this->container)));
            $document = new Document($collection);
            $response = $response->withStatus(200);
            return $response->withJson($document);
        } catch (GeneralException $e) {
            return $this->catchErrorHandler( $response,$e);
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



    public function benchmark()
    {
        $bench = new \Ubench();

        $bench->start();

// Execute some code

        $bench->end();


        $benchmark = [
            'time' => $bench->getTime(),
            'time float' => $bench->getTime(true),
            'time float' => $bench->getTime(true),
            'memory pick' => $bench->getMemoryPeak(),
            'memory pick' => $bench->getMemoryPeak(),
        ];

// Get elapsed time and memory
//        echo $bench->getTime(); // 156ms or 1.123s
//        echo '<hr>';
//        echo '<br>';
//        echo $bench->getTime(true); // elapsed microtime in float
//        echo '<hr>';
//        echo '<br>';
//        echo $bench->getTime(false, '%d%s'); // 156ms or 1s
//        echo '<hr>';
//        echo '<br>';
//
//        echo $bench->getMemoryPeak(); // 152B or 90.00Kb or 15.23Mb
//        echo '<hr>';
//        echo '<br>';
//        echo $bench->getMemoryPeak(true); // memory peak in bytes
//        echo '<hr>';
//        echo '<br>';
//        echo $bench->getMemoryPeak(false, '%.3f%s'); // 152B or 90.152Kb or 15.234Mb
//        echo '<hr>';
//        echo '<br>';
//// Returns the memory usage at the end mark
//        echo $bench->getMemoryUsage(); // 152B or 90.00Kb or 15.23Mb
//        echo '<hr>';
//        echo '<br>';
// Runs `Ubench::start()` and `Ubench::end()` around a callable
// Accepts a callable as the first parameter.  Any additional parameters will be passed to the callable.
        $result = $bench->run(function ($x) {
            return $x;
        }, 1);


        echo json_encode($benchmark);
    }
}
