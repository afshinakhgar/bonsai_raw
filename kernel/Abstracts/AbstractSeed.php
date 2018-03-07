<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 3/7/18
 * Time: 1:20 PM
 */

namespace Kernel\Abstracts;
use Faker\Factory;
use Kernel\Faker\FakerHandler;
use \Phinx\Seed\AbstractSeed as Seeder;

abstract class AbstractSeed extends Seeder
{
    public $faker;

    public function faker()
    {
        $faker =  new FakerHandler();
        $this->faker = $faker->init();
    }
}