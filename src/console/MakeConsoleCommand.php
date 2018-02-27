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

class MakeConsoleCommand extends AbstractConsole
{
    protected function configure(){
        $this->setName("make:console")
            ->setDescription("Create new Command")
            ->addArgument('name', InputArgument::REQUIRED, 'Whats your Command\'s name)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $directory = "src/console/";
        $file = file_get_contents("resources/command_templates/create_command.txt");
        $file = str_replace("!command_name", $name, $file);
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
        if (!file_exists($directory.$name."Command.php")) {
            $fh = fopen($directory . $name . "Command.php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = $name . "Command.php";
            $output->writeln("Created $className in Command");
        } else {
            $output->writeln("Class already Exists!");
        }

    }

}