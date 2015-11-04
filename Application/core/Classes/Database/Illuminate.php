<?php namespace Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;

/**
 * Extends Illuminate database class
 * @link http://laravel.com/api/4.0/Illuminate/Database/Query/Builder.html
 * @link https://github.com/illuminate/database
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Illuminate extends Capsule {

    /**
     * Illuminate DB drive setup & config
     * 28/03/15 , 16:30
     *
     * @return $capsule
     */
    public function __construct(){
        $capsule = new parent();
        $capsule->addConnection(Config::get('database')[Config::get('database.driver')]);
        $capsule->setAsGlobal();
    }


}