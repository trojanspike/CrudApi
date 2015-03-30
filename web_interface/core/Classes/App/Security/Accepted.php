<?php namespace App\Security;

/**
 * Security : check accepted headers and c-types are allowed
 *
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Accepted {
    public static $byPass = false;

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  array    $tests  Array of strings to preg match $accept
     * @param  string  $accept  Header Accept Type
     * @return bool , true = pass | false = fail
     */
    public static function pass( array $tests, $accept )
    {
        if( static::$byPass )
        {
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
