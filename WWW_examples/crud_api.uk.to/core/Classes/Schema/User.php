<?php


class User {
    
    /*
    bin -> schema up | down | myFunc
    */
    
    function up($Schema){
        $Schema->create('users_data', function($table){
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('name', 60);
            $table->string('password', 60);
            $table->timestamps();
        });
    }
    
    function down($Schema){
        $Schema->dropIfExists('users_data');
    }
    
    
    // $ bin/schema version3
    function version3($Schema){
        // $Schema->update('table') , etc
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