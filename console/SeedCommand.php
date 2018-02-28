<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/24/18
 * Time: 3:40 PM
 */

namespace Console;
use Kernel\Abstracts\AbstractConsole;
use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;


class SeedCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('seed')
            ->setDescription('Seed Execution')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('./vendor/bin/phinx seed:run');
        $process->run();
        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }
        print $process->getOutput('Seed Done');
    }

}