<?php namespace App;

use Database\RedisDB;

/**
 * Caching to file or RedisDB
 *
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Cache extends RedisDB {

    private $saveTo;
    private static $DB_Instance = false;
    private static $FILE_Instance = false;

    /**
     * Creates a Cache instance using DB or File
     * 28/03/15 , 16:30
     * @param  string    $type  Cache option to use , "db" or "file", Cache::db(), Cache::file()
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function __construct($type)
    {
         $this->saveTo = $type;
         parent::__construct();
    }

    /**
     * Create Cache::db instance , caching using Redis db
     * 28/03/15 , 16:30
     *
     * @return Cache instance class object
     */
    public static function db()
    {
        if(  static::$DB_Instance )
        {
            return static::$DB_Instance;
        }
        else
        {
            return static::$DB_Instance = new Cache('db');
        }
    }

    /**
     * Create Cache::file instance , caching using Files and Redis DB for tracking
     * 28/03/15 , 16:30
     *
     * @return Cache instance class object
     */
    public static function file()
    {
        if(  static::$FILE_Instance )
        {
            return static::$FILE_Instance;
        }
        else
        {
            return static::$FILE_Instance = new Cache('file');
        }
    }

    /**
     * Get Cache content using a key
     * 28/03/15 , 16:30
     * @param  string    $key  Key pointer to cached content
     * @return string or false if no key found
     */
    public function get($key)
    {
		$key = md5($key);
        switch($this->saveTo)
        {
            case "db":
                return parent::get('CACHE-DB-'.$key);
            break;
            case "file":
                if(parent::get('CACHE-FILE-'.$key))
                {
                    return file_get_contents(path('storage') . '/Cache/' . $key);
                }
                else
                {
                    if( file_exists(path('storage') . '/Cache/' . $key) )
                    {
                        unlink( path('storage') . '/Cache/' . $key );
                    }
                    return false;
                }
            break;
        }
    }

    /**
     * Put | Set Cache content with a key , content and time to expire
     * 28/03/15 , 16:30
     * @param  string       $key        Key pointer to cached content
     * @param  string       $content    Content to cache
     * @param  int          $time       Set a key's time to live in seconds
     *
     * @return void
     */
    public function put($key, $content, int $time)
    {
		$key = md5($key);
        switch($this->saveTo)
        {
            case "db":
                $this->set('CACHE-DB-'.$key, $content);
                $this->expire('CACHE-DB-'.$key, $time);
            break;
            case "file":
                $this->set('CACHE-FILE-'.$key, true);
                $this->expire('CACHE-FILE-'.$key, $time);
                file_put_contents( path('storage').'/Cache/'.$key, $content );
            break;
        }
    }

}
