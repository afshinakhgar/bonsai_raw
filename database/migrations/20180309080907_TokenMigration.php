<?php

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

class TokenMigration extends AbstractMigration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('tokens', function($table)
        {
			$table->increments('id');
			$table->string('code', 5);
			$table->integer('user_id')->unsigned();
			$table->boolean('used')->default(false);
			$table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
		Capsule::schema()->drop('tokens');
    }
}
