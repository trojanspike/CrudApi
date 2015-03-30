<?php

/**
 * Set up database User table using Schema
 * @link http://laravel.com/docs/5.0/schema
 * $ bin/schema up // i.e
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class UserSchema {

    /**
     * Setup Users sql table with the schema using cli $ /bin/schema up
     * 28/03/15 , 16:30
     * @param  class    $Schema  Schama builder class
     *
     * @return void
     */
    function up($Schema)
    {
        $Schema->create('users', function($table){
            $table->string('id', 100)->unique()->default( 'unique'.time() );
            $table->string('email')->unique();
            $table->string('username', 60)->unique();
            $table->string('password', 60);
            $table->string('extra', 60);
            $table->enum('actived', [0, 1]);
            $table->timestamps();
        });
    }

    /**
     * Drop Users sql table using cli $ /bin/schema down
     * 28/03/15 , 16:30
     * @param  class    $Schema  Schama builder class
     *
     * @return void
     */
    function down($Schema)
    {
        $Schema->dropIfExists('users');
    }

}
?>
