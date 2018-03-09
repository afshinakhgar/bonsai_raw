<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/24/18
 * Time: 3:40 PM
 */

namespace Console;
use Kernel\Abstracts\AbstractConsole;
use Phinx\Console\PhinxApplication;
use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;


class MigrateUpCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('migrate:up')
            ->setDescription('Migration Execution')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$command = $this->getApplication()->find('migrate');

		$arguments = array(
			'command' => 'migrate',
		);

		$returnCode = $command->run($input, $output);
    }

}
