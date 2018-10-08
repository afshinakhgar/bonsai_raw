<?php
namespace App\MiddleWare;
use App\Model\Exam;
use App\Model\Lesson;
use App\Model\Study;
use App\Model\User;
use Kernel\Abstracts\AbstractMiddleWare;

class AppMiddleWare extends AbstractMiddleWare
{
    public function __invoke($request, $response, $next )
    {
//        $response->getBody()->write('BEFORE');

        $response = $next($request, $response);





//        $response->getBody()->write('AFTER');
        return $response;
    }
}