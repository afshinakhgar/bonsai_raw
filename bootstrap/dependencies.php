<?php
$container = $app->getContainer();

$container['logger'] = function($container) {
    $setting = $container['settings']['app']['logger'];
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler($setting['path']);
    $logger->pushHandler($file_handler);
    return $logger;
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



$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};





// AUTOMATIC LOADER CLASSES



/*Dynamic containers in services*/
$Directory = new \Kernel\Helpers\DirectoryHelper();
$filesInServices = $Directory->scan(__APP_ROOT__.'/src/app/Services/');
if($filesInServices){
    foreach($filesInServices as $service){
        $content = preg_replace('/.php/','',$service);
        $container[$content] = function () use ($content){
            $class =  '\\App\\Services\\'.$content ;
            return new $class();
        };
    }
}



// data access container
$array = $Directory->scan(__APP_ROOT__.'/src/app/DataAccess/');
foreach($array as $key=>$item){
    if(is_dir($item)){
        $classDataAccessFolder[$item] = $Directory->scan(__APP_ROOT__.'/src/app/DataAccess/'.$item);
    }else{
        $classDataAccessFolder['DataAccess'] = $item;

    }
}
$result = array();
foreach($classDataAccessFolder as $DaFolder=>$DAFile)
{
    if(is_dir($DAFile)){
        foreach($DAFile as $r){
            $dataAccessFiles[$r] = $DaFolder.'\\'.$r;
        }
    }else{
        $dataAccessFiles[$DAFile] = $DaFolder.'\\'.$DAFile;
    }

}

foreach($dataAccessFiles as $key=>$dataAccessFile){
    $contentDataAccess = preg_replace('/.php/','',$dataAccessFile);
    $containerDataAccess = preg_replace('/.php/','',$key);
    $container[$containerDataAccess] = function ($container) use ($contentDataAccess){
        $classDataAccess =  '\\App\\DataAccess\\'.$contentDataAccess ;
        return new $classDataAccess($container);
    };
}




$GLOBALS['container'] = $container;
$GLOBALS['app'] = $app;
$GLOBALS['settings'] = $container['settings'];



return $container;