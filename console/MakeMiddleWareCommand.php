<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/25/18
 * Time: 3:39 PM
 */

namespace Console;


use Kernel\Abstracts\AbstractConsole;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class MakeMiddleWareCommand extends AbstractConsole
{
    protected function configure()
    {
        $this
            ->setName('make:middleware')
            ->setDescription('Create a Middleware Class')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Name of the Class to Create'
            )
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $directory = "app/MiddleWare/";
        $file = file_get_contents("resources/command_templates/create_middleWare.txt");
        $file = str_replace("!name", $name, $file);
        if (is_dir($directory) && !is_writable($directory)) {
            $output->writeln('The "%s" directory is not writable');
            return;
        }
        if (!is_dir($directory)) {

            $helper = $this->getHelper('question');
            $question = new Question('<question>Directory doesn\'t exist. Would you like to try to create it?</question>');
            $q = $helper->ask($input, $output, $question);

            if ($q) {
                @mkdir($directory);
            }

            if (!is_dir($directory)) {
                $output->writeln('<error>Couldn\'t create directory.</error>');
                return;
            }
        }
        if (!file_exists($directory.$name.".php")) {
            $fh = fopen($directory . $name . ".php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = $name . ".php";
            $output->writeln("Created $className in App\\Middleware");
        } else {
            $output->writeln("Class already Exists!");
        }
    }
}