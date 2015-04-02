<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Hooks class for firing events
 *
 *
 * @copyright  31/03/15 , 21:05 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link https://github.com/trojanspike/BasicAuthCRUD-api
 */
class Hooks {

    private static $HookStack = array();

   /**
    * Add event hook
    * Hooks::on('some:event', function($param1, $param2){
        echo "Event fire form {$param1} , username : {$param2}";
    * });
    * 31/03/15 , 21:07
    * @param  string    $key  Hook name
    * @param  func      $func Function to fire
    * @throws Exception If $key is string or $func isn't function
    * @return void
    */
   public static function on( $key, $func )
   {
       if( ! is_string($key) || ! is_callable($func) )
       {
           throw new Exception('Hooks::on error , $1 must be string , $2 must be Function');
       }

       if( ! isset( static::$HookStack[$key] ) )
       {
           static::$HookStack[$key] = [];
           static::$HookStack[$key][]=$func;
       }
       else
       {
           static::$HookStack[$key][]=$func;
       }
   }

    /**
     * Fire | trigger an event to fire
     * Hooks::fire('some:event', array('Api' , 'TestUser') );
     * 31/03/15 , 21:07
     * @param $key String, hook to fire
     * @param array $args , arags to pass to the hook function
     * @return void
     * @throws Exception If key isn't string | args isn't array
     */
    public static function fire( $key, array $args = array() )
    {
        if( ! is_string($key) )
        {
            throw new Exception('Hooks::fire error , $1 must be string');
        }
        if( isset( static::$HookStack[$key] ) )
        {
            foreach( static::$HookStack[$key] as $hook )
            {
                call_user_func_array($hook, $args);
            }
        }
    }

}