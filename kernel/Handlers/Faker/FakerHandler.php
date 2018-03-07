<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/7/18
 * Time: 1:16 PM
 */

namespace Kernel\Faker;


use Faker\Factory;

class FakerHandler
{
    public $providers = [
        'Kernel\Handlers\Faker\Providers\FakerBookProvider',
        'Faker\Provider\Lorem',
    ];


    function init(){
        $faker =  Factory::create();

        foreach($this->providers as $provider){
            $faker->addProvider(new $provider($faker));
        }
        return $faker ;
    }


}