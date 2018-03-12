<?php
namespace Console;

use Kernel\Abstracts\AbstractConsole;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Formatter\OutputFormatterStyle as OutputFormatterStyle;

/**
 * Class ReportCommand
 * @package Console
 */
class ServeCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('serve')
            ->setDescription('Serve the application on the PHP development server.')
            ->addOption(
                '--port',
                null,
                InputOption::VALUE_OPTIONAL,
                'OPTIONAL PORT'
            )
        ;

    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = 8003;

        $style = new OutputFormatterStyle('green');
        $output->getFormatter()->setStyle('fire', $style);
        $output->writeln('<fire>Bonsai development running on http://localhost:'.$port.'</fire>');
        passthru(PHP_BINARY . " -S localhost:{$port} -t public");
    }

}