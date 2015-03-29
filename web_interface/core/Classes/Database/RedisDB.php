<?php namespace Database;

/*
https://github.com/phpredis/phpredis
TODO : Maybe make multiple connections /
aliases and pre fixes?

https://github.com/phpredis/phpredis#expire-settimeout-pexpire
*/

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

use App\Config;
use Redis;

class RedisDB extends Redis {

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
        $RedisConf = Config::get('database.redis');
        $this->connect($RedisConf['host'], $RedisConf['port']);
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
      if(  static::$instance === false )
      {
        return static::$instance = new RedisDB();
      }
      else
      {
        return static::$instance;
      }
    }
}
?>
