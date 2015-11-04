<?php namespace App;

/**
 * Config getter and setter class
 *
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */


class Config {

    private static $_uid, $_set = false;

    /**
     * Get a config option from /core/config/*
     * 28/03/15 , 16:30
     * @param  string    $key   Config option to get, i.e ::get('site.url')
     *
     * @throws Exception If $key isn't a string
     * @return config value if found, else false
     */
    public static function get($key)
    {
        if( is_string($key) )
        {
            if( strpos($key, ".") )
            {
                $keyArr = explode('.', $key);
                return $GLOBALS[static::$_uid.'_'. strtoupper($keyArr[0])][$keyArr[1]];
            }
            else
            {
               return isset( $GLOBALS[ static::$_uid.'_'.strtoupper($key)] )?$GLOBALS[static::$_uid.'_'.strtoupper($key)]:[0];
            }
        }
        else
        {
            throw new \Exception('Type error , :get($1) , $1 must be a string');
        }
    }

    /**
     * Set a config option from /core/config/*
     * 28/03/15 , 16:30
     *
     * @param  string    $key   Config option to set, i.e ::set('site.url')
     * @param  string    $val   Config value
     *
     * @throws Exception If $key isn't a string
     * @return void
     */
    public static function set($key, $val)
    {
        if( is_string($key) && strpos($key, '.') )
        {
            $keyArr = explode('.', $key);
            $GLOBALS[static::$_uid.'_'. strtoupper($keyArr[0])][$keyArr[1]] = $val;
        }
        else
        {
            throw new \Exception('Type error , :set($1,$2) , $1 must be a string');
        }
    }

    /**
     * Return the unique id for use in $GLOBALS , so not to clash with anu other globals
     * 28/03/15 , 16:30
     *
     * @return String , uid
     */
    public static function GetId()
    {
        if( static::$_set === false )
        {
            static::$_set = true;
            return static::$_uid = uniqid();
        }
        else
        {
            return static::$_uid;
        }
    }

}