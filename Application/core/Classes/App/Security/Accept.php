<?php namespace App\Security;

/**
 * Security : check accepted headers and c-types are allowed
 *
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */


class Accept {

	/**
	* Bypass tests, do fake true | pass
	*
	* @var bool
	*/
    private $sentAccept;

    public function __construct($sentAccept=false)
    {
        if( $sentAccept == false )
        {
            return false;
        }
        else
        {
            $this->sentAccept = $sentAccept;
        }
    }

    /**
     * Does something interesting
     * 04/11/15 , 9:47
     * @param  array    $tests  Array of strings to preg match $accept
     * @param  string  $accept  Header Accept Type
     * @return bool , true = pass | false = fail
     */
    public function application($type=false)
    {
        if( $type == false )
        {
            return false;
        }
        if( preg_match( "/application\/{$type}/" , $this->sentAccept ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Does something interesting
     * 04/11/15 , 10:49
     * @param  array    $tests  Array of strings to preg match $accept
     * @param  string  $accept  Header Accept Type
     * @return bool , true = pass | false = fail
     */
    public function text($type=false)
    {
        if( $type == false )
        {
            return false;
        }
        if( preg_match( "/text\/{$type}/" , $this->sentAccept ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  array    $tests  Array of strings to preg match $accept
     * @param  string  $accept  Header Accept Type
     * @return bool , true = pass | false = fail
     */
    public static function pass( array $tests, $accept )
    {
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