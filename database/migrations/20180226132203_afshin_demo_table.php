<?php
use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

class AfshinDemoTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        Capsule::schema()->create('users', function($table)
        {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique()->nullable();
            $table->string('mobile')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('api_token');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    /**
     * Migrate Down.
     */
    public function down()
    {
        Capsule::schema()->drop('users');
    }
}
