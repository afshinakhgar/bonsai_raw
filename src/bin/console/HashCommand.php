<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/24/18
 * Time: 3:40 PM
 */

namespace Console;
use Kernel\Abstracts\AbstractConsole;
use Kernel\Helpers\HashHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;



class HashCommand extends AbstractConsole
{
    protected function configure(){
        $this->setName("hash")
            ->setDescription("Hashes a given string using Bcrypt.")
            ->addArgument('Password', InputArgument::REQUIRED, 'What do you wish to hash)');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $hash = new HashHelper();
        $input = $input->getArgument('Password');
        $result = $hash->hash($input);
        $output->writeln('Your password hashed: ' . $result);
    }

}