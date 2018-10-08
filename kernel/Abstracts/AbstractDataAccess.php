<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 2/27/18
 * Time: 4:08 PM
 */

namespace Kernel\Abstracts;

/**
 * Class AbstractDataAccess
 * @package Kernel\Abstracts
 */

class AbstractDataAccess extends AbstractContainer
{

    public function updateFieldByObj($obj, array $fields)
    {
        foreach ($fields as $field => $value) {
            $obj->$field = $value;
        }
        $obj->save();


        return $obj;
    }
}