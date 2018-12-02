<?php
namespace Console;

use Illuminate\Database\Capsule\Manager as DB;
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
class SchemaCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('schema')
            ->setDescription('schema')
            ->addArgument(
                'table',
                InputArgument::OPTIONAL,
                'Table'
            )
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

        $table_name = $input->getArgument('table');




        if(isset($table_name)){
//            $output->writeln(''.$table_name.'');

            $schema = ($this->getSchema()[$table_name]);
            $newArr = [];
            foreach($schema['attributes'] as $key => $row){
                $newArr[$key] = (array)$row;
            }
            $table = new Table($output);
            $table->setHeaderTitle($table_name.'('.$this->getTableRowCount($table_name).')');

            $table
                ->setHeaders(array('Field','Type', 'Null','Key','Default','Extra'))
                ->setRows(
                    $newArr
                )
            ;
            $table->setStyle('box');

            $table->render();

        }else{
            $schema = ($this->getSchema());

            foreach($schema as $key => $row){
                $table = new Table($output);

                foreach($row['attributes'] as $kk => $rowData){
                    $newArr[$kk] = (array)$rowData;

                }
                $table
                    ->setHeaders(array('Field','Type', 'Null','Key','Default','Extra'))
                    ->setRows(
                        $newArr
                    )
                ;
                $table->setStyle('box');
                $table->setHeaderTitle($key);

                $table->render();

            }




        }




        $table->render();

    }




    public function getTables()
    {

        $database = $GLOBALS['settings']['databases']['db']['database'];
        $combine = "Tables_in_".$database;
        $tables = DB::select('SHOW TABLES');

        $collection = new \Illuminate\Database\Eloquent\Collection;

        foreach($tables as $table){
            $collection->put($table->$combine, $table->$combine);
        }

        return $collection; //or compact('collection'); //for combo select

    }
    public function getColumns($tableName)
    {
        return $this->transformColumns(DB::select("SHOW COLUMNS FROM " . $tableName));

    }
    public function getSchema()
    {
        foreach ($this->getTables() as $table) {
            $columns = $this->getColumns($table);
            $this->schema[$table]['attributes'] = $columns;
            $this->schema[$table]['rowsCount'] = $this->getTableRowCount($table);
        }
        return $this->schema;
    }

    /**
     * Get table total row count
     * @param $table
     * @return mixed
     */
    public function getTableRowCount($table)
    {
        return $this->capsule->table($table)->count();
    }
    /**
     * Perform raw sql query
     * @param $query
     * @return mixed
     */
    public function rawQuery($query)
    {
        return $this->capsule->select(DB::raw($query));
    }

    private function transformColumns($columns)
    {
        return array_map(function ($column) {
            return [
                'Field' => $column->Field,
                'Type' => $column->Type,
                'Null' => $column->Null,
                'Key' => $column->Key,
                'Default' => $column->Default,
                'Extra' => $column->Extra
            ];
        }, $columns);
    }



}