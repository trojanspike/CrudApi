<?php


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