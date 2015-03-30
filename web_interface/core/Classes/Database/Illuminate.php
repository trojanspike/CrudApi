<?php namespace Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;

/**
 * Extends Illuminate database class
 * @link http://laravel.com/api/4.0/Illuminate/Database/Query/Builder.html
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Illuminate extends Capsule {

  protected static $instance = false;

    /**
     * Illuminate DB drive setup & config
     * 28/03/15 , 16:30
     *
     * @throws Exception TODO - DbException
     * @return void
     */
    public function __construct()
    {
        $this->addConnection(Config::get('database')[Config::get('database.driver')]);
        $this->setAsGlobal();
    }

    /**
     * instance if the DB driver
     * 28/03/15 , 16:30
     *
     * @return DB driver instance
     */
    public static function instance()
    {
      if( static::$instance === false )
      {
        return static::$instance = new Illuminate();
      }
      else
      {
        return static::$instance;
      }
    }

}

?>
