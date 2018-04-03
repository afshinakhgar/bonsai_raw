<?php

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('users', function($table)
        {
			$table->increments('id');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('username')->unique()->nullable();
			$table->string('mobile')->unique();

			$table->enum('has_pic',['no','yes'])->default('no');

			$table->string('email')->unique()->nullable();

			$table->string('password');
			$table->string('api_token');

			$table->rememberToken();
			$table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('users');
    }
}
