<?php namespace Database;

/*
Poss change to class , extendable ?
*/
use PDO;
use App\Config;

class PdoConnect {
    private static $dbh = false;
    
    public static function sqlite(){
        try {
        	static::$dbh = new PDO('sqlite:'.Config::get('database.sqlite'), null, null, [PDO::ATTR_PERSISTENT => true]);
        } catch ( PDOException $e ){
            echo $e->getMessage();
            exit();
        }
    }
    
    public function mysql(){
        
        $conf = Config::get('database.mysql');
        $user = $conf['username'];
        $password = $conf['password'];
        $dname = $conf['database'];
        $host = $conf['host'];
        
        
        try {
            static::$dbh = new PDO("mysql:dbname={$dname};host={$host}", $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
    
    public static function getHandler(){
        if(static::$dbh){
            return static::$dbh;
        } else {
         static::mysql();
         return static::$dbh;   
        }
    }
    
    
    
}