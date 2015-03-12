<?php namespace App\Security;


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