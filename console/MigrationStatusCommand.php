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


class MigrationStatusCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('migrate:status')
            ->setDescription('Migration Execution')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('./vendor/bin/phinx status');
        $process->run();
        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }
        print $process->getOutput();
    }

}
