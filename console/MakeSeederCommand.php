<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:45 PM
 */

namespace Console;
use Kernel\Abstracts\AbstractConsole;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class MakeSeederCommand extends AbstractConsole
{
    protected function configure()
    {
        $this
            ->setName('make:seed')
            ->setDescription('Generate Migration Class')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'seeder name to Generate'
            )
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $names   = $input->getArgument('name');
        $directory = 'database/seeds/';
        $file = file_get_contents("resources/command_templates/create_seeder.txt");
        $explodedArrName = explode('_',$names);
        $classNameNew ='';
        foreach($explodedArrName as $parted_names){
            $classNameNew .= ucfirst($parted_names);
        }

        $file = str_replace("!name", ucfirst($classNameNew), $file);
        $file = str_replace("?name", strtolower($classNameNew), $file);

        $explodedArrName = explode('_',$names);
        $fileNameNew ='';
        foreach($explodedArrName as $parted_names){
            $fileNameNew .= ucfirst($parted_names);
        }
        if (!file_exists($directory.ucfirst($fileNameNew).".php")) {
            $fh = fopen($directory .ucfirst($fileNameNew) . ".php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = ucfirst($fileNameNew) . ".php";
            $output->writeln("Created $className Seed in Seeds");
        } else {
            $output->writeln("Class Seed already Exists!");
        }

    }
}
