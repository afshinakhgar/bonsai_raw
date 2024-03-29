<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:45 PM
 */

namespace Console;
use Kernel\Abstracts\AbstractConsole;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class MakeMigrationCommand extends AbstractConsole
{
    protected function configure()
    {
        $this
            ->setName('make:migration')
            ->setDescription('Generate Migration Class')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Migration name to Generate'
            )
			->addOption(
				'table',
				null,
				InputOption::VALUE_OPTIONAL,
				'table model'
			)
            ->addArgument(
                'column',
                InputArgument::IS_ARRAY,
                'column name (column:type) '
            )
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $names   = $input->getArgument('name');
        $column = $input->getArgument('column');

                $map ="";
        $directory = 'database/migrations/';
        $file = file_get_contents("resources/command_templates/create_migration.txt");
        $explodedArrName = explode('_',$names);
        $classNameNew ='';

        foreach($explodedArrName as $parted_names){
            $classNameNew .= ucfirst($parted_names);
        }

        $file = str_replace("!name", ucfirst($classNameNew), $file);
        $file = str_replace("?name", strtolower($classNameNew), $file);

        foreach ($column as $c) {
            $entity = explode(":", $c);
            $name   = $entity[0];
            $type   = $entity[1];
            //$map    .= "$table->".$type."('".$name."');".'\r\n';
            $map    .= '$table->'.$type.'("'.$name.'");'."\n";
        }
        $file = str_replace("!table", $map, $file);
        if($input->getOption('table') !== null){
            $tableName = $input->getOption('table') ?? $name;
            $file = str_replace("!table_name", $tableName, $file);

        }

        $explodedArrName = explode('_',$names);
        $fileNameNew ='';
        foreach($explodedArrName as $parted_names){
            $fileNameNew .= ucfirst($parted_names);
        }
        if (!file_exists($directory.date('YmdHis')."_".ucfirst($fileNameNew).".php")) {
            $fh = fopen($directory .date('YmdHis')."_". ucfirst($fileNameNew) . ".php", "w");
            fwrite($fh, $file);
            fclose($fh);
            $className = ucfirst($fileNameNew) . ".php";
            $output->writeln("Created $className Migration in migrations");
        } else {
            $output->writeln("Class migration already Exists!");
        }

		if($input->getOption('table') !== null)
		{
			$command = $this->getApplication()->find('make:model');

			$arguments = array(
				'command' => 'make:model',
				'name'    => $input->getOption	('table'),
			);

			$greetInput = new ArrayInput($arguments);
			$returnCode = $command->run($greetInput, $output);
		}

    }
}
