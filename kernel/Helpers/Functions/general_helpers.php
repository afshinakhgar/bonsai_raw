<?php

function envY($filePath ,$key, $default = null)
{
    $helper =  new \Kernel\Helpers\EnvHelper();

    return $helper($filePath ,$key, $default = null);
}