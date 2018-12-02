<?php
namespace Console;

use Kernel\Abstracts\AbstractConsole;
use SebastianBergmann\GlobalState\RuntimeException;
use Symfony\Component\Console\Helper\Table;
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
class SchemaTablesCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('schema:tables')
            ->setDescription('SchemaTables')
           ;
    }
    protected $capsul;
    public function __construct(?string $name = null)
    {
        parent::__construct($name);
        $this->capsule = new \Illuminate\Database\Capsule\Manager();
        $this->capsule->addConnection($GLOBALS['settings']['databases']['db']);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaderTitle("TABLES");


        $schema = new SchemaCommand();
        $items = $schema->getTables();
        $newArr = [];
        foreach($items as $row){
            $newArr[] = (array)$row;
        }
        $table
            ->setHeaders(array('Table Name'))
            ->setRows(
                $newArr
            )
        ;
//        $table->setStyle('box');

        $table->render();

    }

}