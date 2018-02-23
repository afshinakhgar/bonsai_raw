<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/23/18
 * Time: 5:23 PM
 */

namespace Kernel\Helpers;

/**
 * Class ConfigHelper
 * @package Kernel\Helpers
 */
class ConfigHelper
{

    /**
     * @param string $dir
     * @return array
     */

    public function loader(string $dir)
    {
        /*Dynamic containers in services*/
        $directory = new DirectoryHelper();
        $filesInConfig = $directory->scan($dir);

        if (!isset($configs)) {
            $configs = array();
        }
        $i=0;
        foreach($filesInConfig as $config_file){
            $file[$i] = include_once  $dir.$config_file;
            if(is_array($file[$i])){
                $configs = array_merge($configs, $file[$i]);
                $i++;
            }
        }


        return $configs;
    }

}