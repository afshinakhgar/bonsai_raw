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
class InitCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('init')
            ->setDescription('Init')
            ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$style = new OutputFormatterStyle('green');
		$output->getFormatter()->setStyle('fire', $style);
		passthru( PHP_BINARY." bonsai migrate");
		passthru( PHP_BINARY ." bonsai seed");

		$output->writeln('<fire>INISIALIZED !! </fire>');


	}

}
