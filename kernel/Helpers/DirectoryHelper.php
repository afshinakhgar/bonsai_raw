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
        if(!is_dir($folder)){
            return false;
        }
        $config_dir = scandir($folder);
        $ex_config_folders = array('..', '.');
        $filesInConfig =  array_diff($config_dir,$ex_config_folders);


        return $filesInConfig;
    }


    private static function create_class_array(string $fullpath, string $filename){

        $class = $fullpath;
        $class = str_replace("../","",$class);
        $class = str_replace("app","App",$class);
        $class = str_replace("/","\\",$class);
        $class = str_replace(".php","",$class);
        return ['class' => $class, 'class_name' => str_replace(".php","",$filename)];
    }

    public static function listFolderFiles($dir, &$results = array()){
        if(is_dir($dir)){
            $files = scandir($dir);
        }

        if(isset($files)){
            foreach($files as $key => $value){
                $path = $dir.DIRECTORY_SEPARATOR.$value;
                if(!is_dir($path) && substr($value, -4) == '.php' && substr( $value, 0, 1 ) != "_") {
                    $results[] = self::create_class_array($path,$value);
                } else if($value != "." && $value != "..") {
                    self::listFolderFiles($path, $results);
                    if ( substr($path, -4) == '.php' && substr( $value, 0, 1 ) != "_") {
                        $results[] = self::create_class_array($path,$value);
                    }
                }
            }
        }

        return $results;
    }

}