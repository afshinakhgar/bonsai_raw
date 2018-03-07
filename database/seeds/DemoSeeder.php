<?php

class DemoSeeder extends \Kernel\Abstracts\AbstractSeed
{
    public function run()
    {
        $this->faker();

        $n = new \App\Model\Demo();
        $n->name =$this->faker->name;
        $n->last = $this->faker->ISBN;
        $n->save();

    }
}