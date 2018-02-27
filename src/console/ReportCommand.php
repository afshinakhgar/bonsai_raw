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

/**
 * Class ReportCommand
 * @package Console
 */

class ReportCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('report')
            ->setDescription('Report Execution')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('php ./vendor/bin/phpmetrics --report-html=storage/report .');
        $process->run();
        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }
        print $process->getOutput();

        $output->writeln(PHP_EOL.'Optimized ');


    }

}