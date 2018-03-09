<?php
namespace Console;

use Kernel\Abstracts\AbstractConsole;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Question\Question;


/**
 * Class ReportCommand
 * @package Console
 */
class MakeDataAccessCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('make:da')
            ->setDescription('MakeDataAccess')
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
		$nameArr = explode('/',$name);

		if(is_array($nameArr)){
			$nameClass = $nameArr[count($nameArr)-1];
		}

        $directory = "app/DataAccess/";
        $file = file_get_contents("resources/command_templates/create_dataaccess.txt");
        $file = str_replace("!name", $nameClass, $file);
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
            $output->writeln("Created $className in App\\DataAccess");
        } else {
            $output->writeln("Class already Exists!");
        }

    }

}
