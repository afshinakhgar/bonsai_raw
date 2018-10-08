<?php
$container = $app->getContainer();

$container['logger'] = function($container) {
    $setting = $container['settings']['app']['logger'];
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler($setting['path']);
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['notFoundHandler'] = function ($container) {
    return function (\Slim\Http\Request $request, \Slim\Http\Response $response) use ($container) {
        return $container['view']->render($response->withStatus(404), '404');
    };
};


$container['mailer'] = function ($container) {
    $mailer = new \Kernel\Services\MailerService($container);
    return $mailer->init();
};

/* database connection */
$container['db'] = function ($container) {
    $db = $container['settings']['databases']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'],
        $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['eloquent'] = function ($container) {
    $db = $container['settings']['databases']['db'];
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($db);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    $capsule::connection()->enableQueryLog();

    return $capsule;
};


// database
$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection($config['settings']['databases']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();



$container['generalErrorHandler'] = function ($container) {
    return new \Kernel\Handlers\ErrorHandler($container['logger']);
};

//
//$container['errorHandler'] = function ($container) {
//    return function ($request, $response, $exception) use ($container) {
//
//
//        $uri          = $request->getUri();
//        $current_path = $uri->getPath();
//        $route        = $request->getAttribute('route');
//        $routeSegment = explode('/',trim($current_path,'/'));
//
//
//        if($routeSegment[0] != 'api'){
//            return '400';
//        }
//        $data = [
//            'code' => $exception->getCode(),
//            'message' => $exception->getMessage(),
//            'file' => $exception->getFile(),
//            'line' => $exception->getLine(),
//            'trace' => explode("\n", $exception->getTraceAsString()),
//        ];
//
//        return $container->get('response')->withStatus(500)
//            ->withHeader('Content-Type', 'application/json')
//            ->write(json_encode($data));
//    };
//};



$container['translator'] = function ($container) {
    $translate = new \Kernel\Helpers\TranslationHelper($container);
    return $translate;
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$container['validator'] = function ($container) {
    $translate = new \Kernel\Validator();
    return $translate;
};
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
$container['filesystem'] = function ($container) {

    $filesystem = $container['settings']['filesystem'] ?? __DIR__.'/../storage';

    $adapter = new Local($filesystem);
    $filesystem = new Filesystem($adapter);

    return $filesystem;
};


// Register Blade View helper
$container['view'] = function ($container) {
    $messages = $container->flash->getMessages();
    $viewSettings = $container['settings']['view'];

    if(!is_dir($viewSettings['blade_cache_path'])){
        @mkdir($viewSettings['blade_cache_path']);
    }

    return new \Slim\Views\Blade(
        [$viewSettings['blade_template_path'].$viewSettings['template']],
        $viewSettings['blade_cache_path'],
        null,
        [
            'translator'=> $container['translator'],
            'messages'=> $messages,
            'settings'  => $container->settings
        ]
    );
};

$app->getContainer()['view']->getRenderer()->getCompiler()->directive('helloWorld', function(){

    return "<?php echo 'Hello Directive'; ?>";
});

$whoopsGuard = new \Zeuxisoo\Whoops\Provider\Slim\WhoopsGuard();
$whoopsGuard->setApp($app);
$whoopsGuard->setRequest($container['request']);
$whoopsGuard->setHandlers([]);
$whoopsGuard->install();

// AUTOMATIC LOADER CLASSES



/*Dynamic containers in services*/
$Directory = new \Kernel\Helpers\DirectoryHelper();
$filesInServices = $Directory->scan(__APP_ROOT__.'/app/Services/');
if($filesInServices){
    foreach($filesInServices as $service){
        $content = preg_replace('/.php/','',$service);
        $container[$content] = function () use ($content){
            $class =  '\\App\\Services\\'.$content ;
            return new $class();
        };
    }
}

$filesInServicesKernel = $Directory->scan(__APP_ROOT__.'/kernel/Services/');
if($filesInServicesKernel){
    foreach($filesInServicesKernel as $serviceKernel){
        $contentKernel = preg_replace('/.php/','',$serviceKernel);
        $container['Kernel_'.$contentKernel] = function () use ($container , $contentKernel){
            $class =  '\\Kernel\\Services\\'.$contentKernel ;
            return new $class($container);
        };
    }
}



$filesInHelpers = $Directory->scan(__APP_ROOT__.'/kernel/Helpers/');

if($filesInHelpers){
    foreach($filesInHelpers as $helper){
        $contentHelper = preg_replace('/.php/','',$helper);
        $container[$contentHelper] = function ($container) use ($contentHelper){
            $class =  '\\Kernel\\Helpers\\'.$contentHelper ;
            return new $class($container);
        };
    }
}
// data access container
$dataAccessFiles = $Directory->listFolderFiles(__APP_ROOT__.'/app/DataAccess/');


foreach($dataAccessFiles as $key=>$item){
    $arrayC = str_replace(str_replace('/','\\',__DIR__),'',$item['class']);

    $classDataAccessFolder[$item['class_name']] = trim(str_replace("\\\\","\\",$arrayC),'\\');


}
$result = array();
foreach($classDataAccessFolder as $key=>$dataAccessFile){
    $container[$key] = function ($container) use ($dataAccessFile){
        return new $dataAccessFile($container);
    };
}



$GLOBALS['container'] = $container;
$GLOBALS['app'] = $app;
$GLOBALS['settings'] = $container['settings'];


$view =   ($container['view']);

\Illuminate\Pagination\Paginator::viewFactoryResolver(function() use ($view) {
    return new class($view) {
        private $view;
        private $template;
        private $data;

        public function __construct(\Slim\Views\Blade $view)
        {
            $this->view = $view;
        }

    };
});
\Illuminate\Pagination\Paginator::currentPageResolver(function() use ($container)  {
    return $container['request']->getParam('page');
});


return $container;
