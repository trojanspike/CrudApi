<?php namespace Conn;

use PDO;

class Database {
    private static $dbh;
    
    public static function sqlite($file=false){
        try {
        	static::$dbh = new PDO('sqlite:'.$file, null, null, [PDO::ATTR_PERSISTENT => true]);
        } catch ( PDOException $e ){
            echo $e->getMessage();
            exit();
        }
    }
    
    public static function getHandler(){
        return static::$dbh;
    }
    
}

?>