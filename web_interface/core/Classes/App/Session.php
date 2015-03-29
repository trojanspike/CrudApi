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
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public static function start()
    {
        if( ! isset( $_SESSION['_CSRF'] ) )
        {
            $_SESSION['_CSRF'] = hash( 'tiger128,4' , uniqid());
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
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public static function set($key, $val)
    {
        $_SESSION[$key]=$val;
    }


}

?>
