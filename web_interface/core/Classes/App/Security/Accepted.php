<?php namespace App\Security;

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

class Accepted {
    public static $byPass = false;
    public static function pass( array $tests, $accept )
    {
        if( static::$byPass ){
            return true;
        }
        foreach( $tests as $test )
        {
            if( ! preg_match($test, $accept) )
            {
                return false;
            }
        }
        return true;
    }

}


?>