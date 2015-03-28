<?php namespace Database;
// http://laravel.com/api/4.0/Illuminate/Database/Query/Builder.html
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;

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

class Illuminate extends Capsule {
    
    public function __construct(){
        $capsule = new Capsule;
        $capsule->addConnection(Config::get('database')[Config::get('database.driver')]); 
        $capsule->setAsGlobal();
    }

    public static function instance(){
        return new Illuminate();
    }
    
}

?>