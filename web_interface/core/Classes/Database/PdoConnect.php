<?php namespace Database;

/*
Poss change to class , extendable ?
*/
use PDO;
use App\Config;

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