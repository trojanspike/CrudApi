<?php namespace App;

/**
 * Session getter and setter class
 *
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Session {

    /**
     * Gets a value
     * 28/03/15 , 16:30
     * @param  string       $key Key of array
     * @return Value or false if not set
     */
	public function __get($key)
  {
		return ( isset( $_SESSION[$key] ) )?$_SESSION[$key]:false;
	}

    /**
     * Set a value
     * 28/03/15 , 16:30
     * @param  string       $key Key of array
     * @param  any          $val Value set to the key
     * @return void
     */
	public function __set($key, $val)
  {
		$_SESSION[$key] = $val;
	}

    /**
     * start an App session and set _CSRF value to use on forms
     * 28/03/15 , 16:30
     *
     * @return void
     */
    public static function start()
    {
        if( ! isset( $_SESSION['_CSRF'] ) )
        {
            $_SESSION['_CSRF'] = hash( 'tiger128,4' , uniqid());
        }
    }

    /**
     * Get a value from SESSION array using the key passed
     * 28/03/15 , 16:30
     * @param  string    $key  Key of SESSION array or empty to return full $_SESSION
     *
     * @return Key value or $_SESSION , else false if $key pass and not found
     */
    public static function get($key=false)
    {
        if($key)
        {
            return isset( $_SESSION[$key] )?$_SESSION[$key]:false;
        }
        else
        {
            return $_SESSION;
        }
    }

    /**
     * Set a value in SESSION array
     * 28/03/15 , 16:30
     * @param  string    $key  Where something interesting takes place
     * @param  *        $val    Value to set onto the SESSION key
     *
     * @return void
     */
    public static function set($key, $val)
    {
        $_SESSION[$key]=$val;
    }


}

?>
