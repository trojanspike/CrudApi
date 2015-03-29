<?php namespace Database;

/*
Poss change to class , extendable ?
*/
use PDO;
use App\Config;

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

class PdoConnect extends PDO {

  private static $instance = false;

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    function __construct()
    {
        $conf = Config::get('database.mysql');
        $user = $conf['username'];
        $password = $conf['password'];
        $dname = $conf['database'];
        $host = $conf['host'];


        try {
            parent::__construct("mysql:dbname={$dname};host={$host}", $user, $password);
        }
        catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
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
    public static function instance()
    {
      if( static::$instance === false )
      {
        return static::$instance = new PdoConnect();
      }
      else
      {
        return static::$instance;
      }
    }
}
