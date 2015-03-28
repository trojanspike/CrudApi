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
    
    function __construct(){
        $conf = Config::get('database.mysql');
        $user = $conf['username'];
        $password = $conf['password'];
        $dname = $conf['database'];
        $host = $conf['host'];
        
        
        try {
            parent::__construct("mysql:dbname={$dname};host={$host}", $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function instance(){
        return new PdoConnect();
    }
}