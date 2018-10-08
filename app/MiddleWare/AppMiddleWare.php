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
        $total_users = User::count();
        $total_studdies = Study::count();
        $total_lessons = Lesson::count();
        $total_exams = Exam::count();

        $GLOBALS['views'] = [
            'total_registered_users' => (int)$total_users,
            'total_Studdies' => (int)$total_studdies,
            'total_lessons' => (int)$total_lessons,
            'total_exams' => (int)$total_exams,
        ];
        $response = $next($request, $response);





//        $response->getBody()->write('AFTER');
        return $response;
    }
}