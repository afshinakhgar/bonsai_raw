<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 2:33 PM
 */

namespace Console;


use Kernel\Abstracts\AbstractConsole;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MakeControllerCommand extends AbstractConsole
{
    protected function configure(){
        $this->setName("make:controller")
            ->setDescription("Create new Controller")
            ->addArgument('name', InputArgument::REQUIRED, 'Whats your Controller\'s name)');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $name = $input->getArgument('name');
        $directory = "src/app/Controller/";
        $file = file_get_contents("resources/command_templates/create_controller.txt");
        $hasNamespace = false;



        if(strpos($name,'/') != 0){
            $hasNamespace = true;
            $controllerArr = explode('/',$name);
            $name = $controllerArr[count($controllerArr)-1];
            unset($controllerArr[count($controllerArr)-1]);
            $controller_path = '';
            $namespace = '';
            foreach($controllerArr as $controller_item){
                $controller_path .= ucfirst($controller_item).'/';
                $namespace .= ucfirst($controller_item).'\\';
            }
            $directory .= $controller_path;

            $namespace = rtrim($namespace,'\\');

            $file = str_replace("!use_controller", "use App\\Controller\\Controller;", $file);

            $file = str_replace("!namespace", "App\\Controller\\{$namespace}", $file);


        }else{
            $file = str_replace("!use_controller", "", $file);

            $file = str_replace("!namespace", "App\\Controller", $file);
        }
        $file = str_replace("!controllerName", ucfirst($name), $file);


        if (is_dir($directory) && !is_writable($directory)) {
            $output->writeln('The "%s" directory is not writable');
            return;
        }


        if (!is_dir($directory)) {

            $helper = $this->getHelper('question');
            $question = new Question('<question>Directory doesn\'t exist at : '.$directory.'. Would you like to try to create it?</question>');
            $q = $helper->ask($input, $output, $question);
            if ($q) {
                @mkdir($directory);
            }


            @mkdir($directory);
            if (!is_dir($directory)) {
                $output->writeln('<error>Couldn\'t create directory.</error>');
                return;
            }
        }

        if (!file_exists($directory.ucfirst($name).".php")) {
            $fh = fopen($directory . ucfirst($name) . ".php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = ucfirst($name) . ".php";
            if($hasNamespace){
                $output->writeln("Created $className in App\\Controller\\{$namespace}");

            }else{
                $output->writeln("Created $className in App\\Controller");

            }
        } else {
            $output->writeln("Class Action already Exists!");
        }

    }

}