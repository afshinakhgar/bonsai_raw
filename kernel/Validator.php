<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/7/18
 * Time: 7:35 PM
 */

namespace Kernel;


use Awurth\SlimValidation\Validator as ValidationValidate;

class Validator extends ValidationValidate
{
    public function __construct($showValidationRules = true, $defaultMessages = [])
    {
        parent::__construct($showValidationRules, $defaultMessages);
    }
}