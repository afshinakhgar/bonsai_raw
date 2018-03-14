<?php
namespace Console;

use Illuminate\Events\Dispatcher;
use Kernel\Abstracts\AbstractConsole;
use SebastianBergmann\GlobalState\RuntimeException;
use Slim\Container;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class ReportCommand
 * @package Console
 */
class HappyCommand extends AbstractConsole
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('happy')
            ->setDescription('happy');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = new Container();
        $dispatcher = new Dispatcher();
        $container['events'] = $dispatcher;
        $db = $this->initEloquent($container);
        // begin init SQL logger
        $dispatcher->listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
            $msg =  "== SQL: ".$query->sql."\n";
            $msg .= "== Params: ".join(', ', $query->bindings);
            $msg .= "\n\n";
            // if code is executed in CLI, echo message
            if (php_sapi_name() == 'cli') {
                echo $msg;
            }
            // if code executed by server, log message so stderr
            else {
                $msg = "[".date("Y-m-d H:i:s")."]\n" . $msg;
                file_put_contents(__DIR__.'storage/logs/db.log', $msg, FILE_APPEND); // log into file
                error_log($msg); // log into stderr. usable in php builtin server
            }
        });
        $configFile = 'psysh.config.php';
        $sh = new \Psy\Shell(new \Psy\Configuration(['configFile' => $configFile]));
        $sh->setScopeVariables(get_defined_vars());
        $sh->run();
    }


    protected function initEloquent()
    {
        $connection = Capsule::connection();
        return $connection;
    }

}