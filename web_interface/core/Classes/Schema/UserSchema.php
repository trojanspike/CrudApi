<?php

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
    
    /*
    bin -> schema up | down | myFunc
    */
    
    function up($Schema){
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
    
    function down($Schema){
        $Schema->dropIfExists('users');
    }
    
}
?>