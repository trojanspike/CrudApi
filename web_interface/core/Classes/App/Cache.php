<?php namespace App;

use Database\RedisDB;

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

class Cache extends RedisDB {

    private $saveTo, $uid = false;
    private static $DB_Instance = false;
    private static $FILE_Instance = false;

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function __construct($type)
    {
         $this->saveTo = $type;
         parent::__construct();
    }

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
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
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
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
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
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
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function put($key, $content, $time)
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
