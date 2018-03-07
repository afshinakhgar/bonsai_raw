<?php
$container = $app->getContainer();

$container['logger'] = function($container) {
    $setting = $container['settings']['app']['logger'];
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler($setting['path']);
    $logger->pushHandler($file_handler);
    return $logger;
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


// Register Blade View helper
$container['view'] = function ($container) {
    $messages = $container->flash->getMessages();

    if(!is_dir('../app/View/cache')){
        @mkdir('../app/View/cache');
    }

    $viewSettings = $container['settings']['view'];
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



$filesInHelpers = $Directory->scan(__APP_ROOT__.'/kernel/Helpers/');
if($filesInServices){
    foreach($filesInServices as $service){
        $contentHelper = preg_replace('/.php/','',$service);
        $container[$contentHelper] = function () use ($contentHelper){
            $class =  '\\Kernel\\Helpers\\'.$contentHelper ;
            return new $class();
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



return $container;
