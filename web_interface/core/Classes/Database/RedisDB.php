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
    
    public function __construct(){
        $RedisConf = Config::get('database.redis');
        $this->connect($RedisConf['host'], $RedisConf['port']);
    }

    public static function instance(){
        return new RedisDB();
    }
}
?>