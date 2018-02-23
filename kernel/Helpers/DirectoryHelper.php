<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/23/18
 * Time: 5:24 PM
 */

namespace Kernel\Helpers;


class DirectoryHelper
{
    public function scan($folder)
    {
        $config_dir = scandir($folder);
        $ex_config_folders = array('..', '.');
        $filesInConfig =  array_diff($config_dir,$ex_config_folders);


        return $filesInConfig;
    }
}