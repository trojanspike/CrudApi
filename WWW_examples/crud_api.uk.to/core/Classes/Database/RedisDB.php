<?php namespace Database;

/*
https://github.com/phpredis/phpredis
TODO : Maybe make multiple connections /
aliases and pre fixes?
*/

use App\Config;
use Redis;

class RedisDB extends Redis {
    
    public function __construct(){
        $RedisConf = Config::get('database.redis');
        $this->connect($RedisConf['host'], $RedisConf['port']);
    }
}
?>