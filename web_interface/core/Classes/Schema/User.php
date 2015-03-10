<?php


class User {
    
    /*
    bin -> schema up | down | myFunc
    */
    
    function up($Schema){
        $Schema->create('users', function($table){
            $table->increments('id');
            // $table->string('email')->unique();
            $table->string('username', 60);
            $table->string('password', 60);
            $table->string('extra', 60);
            $table->timestamps();
        });
    }
    
    function down($Schema){
        $Schema->dropIfExists('users');
    }
    
}


/**
Illuminate::schema()->create('users123', function($table)
    {
        $table->increments('id');
        $table->string('email')->unique();
        $table->timestamps();
    });

**/
?>