<?php
namespace Console;

use Kernel\Abstracts\AbstractConsole;
use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;


/**
 * Class ReportCommand
 * @package Console
 */
class MigrateRollBackCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('migrate:down')
            ->setDescription('MigrateRollBack');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('./vendor/bin/phinx rollback');
        $process->run();
        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }
        print $process->getOutput();
    }

}