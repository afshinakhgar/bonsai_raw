<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/9/18
 * Time: 4:33 PM
 */

namespace App\Controller\Api\V1\User;


use App\Controller\_Controller;
use App\Model\User;
use App\Serializer\Api\V1\Study\ExamAttendSerializer;
use App\Serializer\Api\V1\User\AuthenticateSerializer;
use App\Serializer\Api\V1\User\UserSerializer;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Kernel\Facades\Auth;
use Kernel\Helpers\HashHelper;
use Kernel\JsonApi\Exceptions\GeneralException;
use Slim\Http\Request;
use Slim\Http\Response;
use Tobscure\JsonApi\Collection;
use Tobscure\JsonApi\Document;
use Respect\Validation\Validator as v;

class UserController extends _Controller
{

    public function index(Request $request , Response $response , $args)
    {



        try {
//            print_r($request->getAttribute('decoded_token_data'));

//            $study = [];
//
            $limit     = 2; // Number of posts on one page
            $list = $this->UserDataAccess->getAllUsersPaging($limit);


            $pagingData = $this->PagerHelper->pagingData($request,$list,$limit);







            $collection = (new Collection($list, new UserSerializer($this->container)));
            $document = new Document($collection);
            $document->addPaginationLinks(
                route('api.user.list'), // The base URL for the links
                [],    // The query params provided in the request
                $pagingData['page'],    // The current offset
                $limit,    // The current limit
                $pagingData['count']    // The total number of results
            );
            $response = $response->withStatus(200);
            return $response->withJson($document);

        } catch (GeneralException $e) {
            return $this->catchErrorHandler( $response,$e);
        }
    }




    public function show(Request $request , Response $response , $args)
    {
        try {
//            print_r($request->getAttribute('decoded_token_data'));

//            $study = [];
//            $data = $this->UserDataAccess->getById($args['id']);


            $user = $this->UserDataAccess->getUserWithUsername($args['username']);



            $data[] = $user;

            $collection = (new Collection($data, new UserSerializer($this->container)))->with(['study']);
            $document = new Document($collection);

            $response = $response->withStatus(200);
            return $response->withJson($document);

        } catch (GeneralException $e) {
            return $this->catchErrorHandler( $response,$e);
        }
    }




    public function attend_exam(Request $request , Response $response , $args)
    {
        try {


            $logindata = $request->getAttribute('decoded_token_data');

//            $study = [];
            $user  = Auth::user($logindata);
            $userid = $user->id;
            $exam = $this->ExamDataAccess->getById($args['exam_id']);


//
            if(!$exam->id){
                return $this->badRequest($response, ['Exam doesnt exists'],400);
            }
//            if($exam->user()->count() > 0){
//                return $this->badRequest($response, ['user already attend'],400);
//            }

//            $user = $this->UserDataAccess->getUserById((int)$userid);


//            dd(Auth::user());

            $sumc = $this->UserDataAccess->attendExam($user,[$args['exam_id']]);



            $data[] = (object)[
                'user_id'=>$user->id,
                'exam_id'=>$exam->id,
            ];
            $collection = (new Collection($data, new ExamAttendSerializer($this->container)));
            $document = new Document($collection);

            $response = $response->withStatus(200);
            return $response->withJson($document);

        } catch (GeneralException $e) {
            return $this->catchErrorHandler( $response,$e);
        }
    }


}
