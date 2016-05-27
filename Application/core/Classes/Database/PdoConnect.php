<?php namespace Database;

/*
Poss change to class , extendable ?
*/
use PDO;
use App\Config;

/**
 * Extends PDO database class
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class PdoConnect extends PDO {

  protected static $instance = false;

    /**
     * PDO driver setup and Config
     * 28/03/15 , 16:30
     *
     * @throws PDOException if any fails
     * @return Status
     */
    function __construct() /* TODO - check Config and if dev show more fail info */
    {
        $conf = Config::get('database.mysql');
        $user = $conf['username'];
        $password = $conf['password'];
        $dbname = $conf['database'];
        $host = $conf['host'];


        try {
            parent::__construct("mysql:dbname={$dbname};host={$host};charset=utf8", $user, $password);
        }
        catch (\PDOException $e)
        {
            die( 'Connection failed: ' . $e->getMessage() );
        }
    }

    /**
     * instance if the DB driver
     * 28/03/15 , 16:30
     *
     * @return DB driver instance
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
