<?php namespace App;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  24/04/15 , 14:36 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version
 * @link
 * @since
 */
class Start {
    /**
    * Var info
    *
    * @var $var
    */
    private $var1;
    public $var2;
    private $GetterSetter = array();

    /**
     * Does something interesting
     * 24/04/15 , 14:36
     * @param  type    $name  What it does
     * @throws Exception If something interesting cannot happen
     * @return Info
     */
    public function __construct()
    {

    }

    /**
     * Gets a value
     * 24/04/15 , 14:36
     * @param  string       $key Key of array
     * @return Value or false if not set
     */
    public function __get( string $key )
    {
        return ( isset( $this->GetterSetter[$key] ) )?$this->GetterSetter[$key]:false;
    }

    /**
     * Set a value
     * 24/04/15 , 14:36
     * @param  string       $key Key of array
     * @param  any          $val Value set to the key
     * @return void
     */
    public function __set( string $key, $val )
    {
        $this->GetterSetter[$key] = $val;
    }

}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */