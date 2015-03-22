<?php namespace App;

use Database\RedisDB;
use App\Session;

class Cache extends RedisDB {

    private $saveTo, $uid = false;
    private static $DB_Instance = false;
    private static $FILE_Instance = false;

    public function __construct($type){
         $this->saveTo = $type;
			/* Session::get('user_id') */
         parent::__construct();
    }

    public static function db(){
        if(  static::$DB_Instance ){
            return static::$DB_Instance;
        } else {
            return static::$DB_Instance = new Cache('db');
        }
    }
    public static function file(){
        if(  static::$FILE_Instance ){
            return static::$FILE_Instance;
        } else {
            return static::$FILE_Instance = new Cache('file');
        }
    }


    public function get($key){
        switch($this->saveTo){
            case "db":
                return parent::get('CACHE_DB_'.$key);
            break;
            case "file":
                if(parent::get('CACHE_FILE_'.$key)) {
                    return file_get_contents(path('storage') . '/Cache/' . $key);
                } else {
                    if( file_exists(path('storage') . '/Cache/' . $key) ){
                        unlink( path('storage') . '/Cache/' . $key );
                    }
                    return false;
                }
            break;
        }
    }
    public function put($key, $content, $time){
        switch($this->saveTo){
            case "db":
                $this->set('CACHE_DB_'.$key, $content);
                $this->expire('CACHE_DB_'.$key, $time);
            break;
            case "file":
                $this->set('CACHE_FILE_'.$key, true);
                $this->expire('CACHE_FILE_'.$key, $time);
                file_put_contents( path('storage').'/Cache/'.$key, $content );
            break;
        }
    }

}

/*
 if( $c = Cache::db()->get('/path/to/file.txt') ){
    echo $c;
} else {
    Cache::db()->put('/path/to/file.txt', file_get_contents('/path/to/file.txt'), 3500);
}

 if( $c = Cache::file()->get('/path/to/file.txt') ){
    echo $c;
} else {
    Cache::file()->put('/path/to/file.txt', file_get_contents('/path/to/file.txt'), 3500);
}
 */
