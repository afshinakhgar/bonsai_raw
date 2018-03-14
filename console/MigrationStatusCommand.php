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
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
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
            ->setDescription('Migration STATUS ')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $style = new OutputFormatterStyle('green');
        $output->getFormatter()->setStyle('fire', $style);
        $output->writeln('<fire>Bonsai Migration status</fire>');
        passthru('./vendor/bin/phinx status');


    }

}
