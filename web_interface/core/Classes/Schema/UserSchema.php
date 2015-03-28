<?php
// http://laravel.com/docs/5.0/schema

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license
 * @version
 * @link
 * @since
 */

class UserSchema {

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    function up($Schema)
    {
        $Schema->create('users', function($table){
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username', 60)->unique();
            $table->string('password', 60);
            $table->string('extra', 60);
            $table->enum('actived', [0, 1]);
            $table->timestamps();
        });
    }

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    function down($Schema)
    {
        $Schema->dropIfExists('users');
    }
    
}
?>