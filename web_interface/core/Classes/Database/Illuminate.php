<?php namespace Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;

class Illuminate extends Capsule {
    
    public function __construct(){
        $capsule = new Capsule;
        $capsule->addConnection(Config::get('database')[Config::get('database.driver')]); 
        $capsule->setAsGlobal();
    }
    
}

?>