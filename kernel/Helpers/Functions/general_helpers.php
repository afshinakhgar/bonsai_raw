<?php

function envY($filePath ,$key, $default = null)
{
    $helper =  new \Kernel\Helpers\EnvHelper();

    return $helper($filePath ,$key, $default = null);
}


if(!function_exists('trans')){
    function trans($key)
    {

        $translate = new \Kernel\Helpers\TranslationHelper($GLOBALS['container']);
        return $translate->trans($key);
    }
}



function route(string $name ,array $params = [],$abs = false)
{
    $url = new \Kernel\Helpers\UrlHelper($GLOBALS['container']);
    $base = '';
    if($abs){
        $base = $url->getBasePath($GLOBALS['container']->request);
    }

    return $base.$url->get($name , $params);
}

function public_path(string $uri = '') {
    $container = $GLOBALS['container'];
    $settings = $container->settings;
    $request = $container->request;

    $url = new \Kernel\Helpers\UrlHelper($container);

    $url_asset = $url->getBasePath($request) .'/'. $uri;
    return $url_asset;
}

if (!function_exists('base_path')) {
    /**
     * Get the path to the base folder
     *
     * @return string
     */
    function base_path()
    {
        return dirname(__DIR__);
    }
}
if (!function_exists('app_path')) {
    /**
     * Get the path to the application folder
     *
     * @return string
     */
    function app_path()
    {
        return base_path() . '/app';
    }
}
if (!function_exists('config_path')) {
    /**
     * Get the path to the config folder
     *
     * @return string
     */
    function config_path()
    {
        return base_path() . '/config';
    }
}

if (!function_exists('storage_path')) {
    /**
     * Get the path to the storage folder
     *
     * @return string
     */
    function storage_path()
    {
        return (public_path() . '/../storage');
    }
}

function excel_path()
{
    return (public_path() . '/excel_export/');

}
function asset(string $uri = '') {
    $url = public_path();
    $url_asset = $url.'assets/'.$uri;
    return $url_asset;
}

function get_gravatar( $email, $s = 380, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}




function jalaliDate($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa')
{
    $jdate = new \Kernel\Helpers\JalaliDateHelper();
    return $jdate->jdate($format,$timestamp,$none,$time_zone,$tr_num);
}



/*folder*/
function getImageDirName($photoid, $type = 'user_profile' ,$collectionNum =1000)
{
    $folderName = null;
    switch ($type) {
        case 'user_profile':
            $folderName = (int) ($photoid / $collectionNum);
            $folderName++;
            $dir = 'user_profile/'.$folderName.'/';
            break;

    }

    if ($folderName) {
        $folderName = $dir;
    }else{
        $folderName = (int) ($photoid / $collectionNum);
        $folderName++;
        $folderName = $type.'/'.$folderName.'/';
    }

    return $folderName;
}

function getImageFileName($photoid,$fileType='l',$type='user_profile')
{
    $fileName = null;

    switch ($type) {
        case 'user_profile':
            $fileName = 'user'.(int)$photoid.'-'.$fileType;
            break;
        default :
            $fileName = (int)$photoid.'-'.$fileType;
            break;
    }


    return $fileName;
}



function hasPerm($permission)
{
    $roles = \Kernel\Facades\Auth::user()->roles;
    foreach($roles as $role){
        foreach($role->permission as $perm){
            if($perm->name == $permission ){
                return true;
            }
        }
    }
    return false;
}