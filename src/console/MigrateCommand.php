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


class MigrateCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('migrate')
            ->setDescription('Migration Execution')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('./vendor/bin/phinx migrate');
        $process->run();
        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }
        print $process->getOutput('Migrate Done');
    }

}