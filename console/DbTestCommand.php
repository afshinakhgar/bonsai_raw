<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/24/18
 * Time: 3:40 PM
 */

namespace Console;
use Kernel\Abstracts\AbstractConsole;
use Kernel\Helpers\HashHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;



class DbTestCommand extends AbstractConsole
{
    protected function configure(){
        $this->setName("dbtest")
            ->setDescription("TestDatabase Connection");
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $capsule = new \Illuminate\Database\Capsule\Manager();
        $capsule->addConnection($GLOBALS['settings']['databases']['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        dd($capsule);

//
//
//        $db = $GLOBALS['settings']['databases']['db'];
//        $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'],
//            $db['username'], $db['password']);
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//
//        dd($pdo);


    }

}