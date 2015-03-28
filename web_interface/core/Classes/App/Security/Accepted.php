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
    public static $byPass = false; /* TODO - use Config:: */

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
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