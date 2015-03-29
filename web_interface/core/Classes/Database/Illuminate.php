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

  private static $instance = false;

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection(Config::get('database')[Config::get('database.driver')]);
        $capsule->setAsGlobal();
    }

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
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
