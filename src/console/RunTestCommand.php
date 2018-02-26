<?php


namespace Console;

use Kernel\Abstracts\AbstractConsole;
use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputArgument;

class RunTestCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('test')
            ->setDescription('Test Api Run')
            ->addArgument(
                'path',
                InputArgument::OPTIONAL,
                'path of test'
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $validPaths = [
            'app','api'
        ];

        $path = $input->getArgument('path');
        $path = isset($path) ? $path : 'app';
        $dir = $this->getPath($path);


        if(!in_array($path,$validPaths)){
            $output->writeln('Problem With Path');
            return;
        }

        foreach($dir as $testFile){
            $process = new Process('./vendor/bin/phpunit '. __APP_ROOT__.'src/tests/'.ucwords($path).'/'.$testFile);
            $process->setTimeout(3600);


            $process->run();

            if (!$process->isSuccessful()) {
                throw new RuntimeException($process->getErrorOutput());
            }

            print $process->getOutput();

        }


        $output->writeln(PHP_EOL.'Test Completed');
        return;

    }


    public function getPath($path)
    {
        $dir = scandir(__APP_ROOT__.'src/tests/'.ucwords($path));
        var_dump(__APP_ROOT__.'src/tests/'.$path);exit;
        $ex_folders = array('..', '.');

        return array_diff($dir,$ex_folders);
    }


}