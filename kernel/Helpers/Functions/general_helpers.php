<?php

function envY($filePath ,$key, $default = null)
{
    $helper =  new \Kernel\Helpers\EnvHelper();

    return $helper($filePath ,$key, $default = null);
}


if(!function_exists('trans')){
    function trans($key)
    {
        return $GLOBALS['container']->translator()->trans($key);
    }
}