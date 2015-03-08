<?php namespace Conn;
/*
https://github.com/illuminate/database/blob/master/Capsule/Manager.php

http://laravel.com/api/5.0/Illuminate/Database/SQLiteConnection.html

*/

use Illuminate\Database\Capsule\Manager as Capsule;

// use Illuminate\Events\Dispatcher;
// use Illuminate\Container\Container;
// $capsule->setEventDispatcher(new Dispatcher(new Container));

use App\Config;

class Illuminate extends Capsule {
    
    public function __construct(){
        
        $capsule = new Capsule;
        $capsule->addConnection(Config::get('database')[Config::get('database.driver')]); 
        
        
        // Make this Capsule instance available globally via static methods... (optional)
       $capsule->setAsGlobal();
        
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        // $capsule->bootEloquent();
        
       // $results = Capsule::table('users')->where('id', '>', '10')->where('id', '<', '35')->get();
        // $results = Capsule::select('select * from users');
        return Capsule;
    }
}

?>