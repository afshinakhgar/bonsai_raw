<?php

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateDemoTable extends AbstractMigration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('demo', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('last');

            $table->timestamps();

        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('demo');
    }
}