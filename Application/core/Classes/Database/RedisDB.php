<?php namespace Database;

/*
TODO : Maybe make multiple connections /
*/

/**
 * Extends RedisDB database class
 * @link https://github.com/phpredis/phpredis
 * @link https://github.com/phpredis/phpredis#expire-settimeout-pexpire
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

use App\Config;
use Redis;

class RedisDB extends Redis {

  protected static $instance = false;

    /**
     * Redis DB setup and Config
     * 28/03/15 , 16:30
     *
     * @return void
     */
    public function __construct()
    {
        $RedisConf = Config::get('database.redis');
        $this->connect($RedisConf['host'], $RedisConf['port']);
    }

    /**
     * instance if the DB driver
     * 28/03/15 , 16:30
     *
     * @return DB driver instance
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