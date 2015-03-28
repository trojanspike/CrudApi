<?php namespace App;

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

class Config {
    
    private static $_uid, $_set = false;
    
    /*
    get('site.debug')
    $GLOBAL['site']['debug']
    */
    
    public static function get($key){
        /* isset -> explode('.', $key) */
        if( is_string($key) ){
            if( strpos($key, ".") ){
                $keyArr = explode('.', $key);
                return $GLOBALS[static::$_uid.'_'. strtoupper($keyArr[0])][$keyArr[1]];
            } else {
               return isset( $GLOBALS[ static::$_uid.'_'.strtoupper($key)] )?$GLOBALS[static::$_uid.'_'.strtoupper($key)]:[0];
                // return $GLOBALS;
            }
        } else {
            /* Error needs to be string */
        }
    }
    
    /*
    set('site.debug', false)
    $GLOBAL['site']['debug'] = false
    */
    
    public static function set($key, $val){
        if( is_string($key) && strpos($key, '.') ){
            $keyArr = explode('.', $key);
            $GLOBALS[static::$_uid.'_'. strtoupper($keyArr[0])][$keyArr[1]] = $val;
        } else {
            // @ERROR
        }
    }
    
    /*
    getAll('site')
    $GLOBALS['site']
    */
    
    public static function GetId(){
        if( static::$_set == false ){
            static::$_set = true;
            return static::$_uid = uniqid();   
        } else {
            return static::$_uid;
        }
    }
    
}


?>