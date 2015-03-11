<?php namespace Model;

use Database\PdoConnect;
use Database\RedisDB;
use PDO;
use App\Session;
use App\Config;

class Users extends PdoConnect {
   
    private $redis;
    
    public function __construct(){
        $this->redis = new RedisDB;
        parent::__construct();
    }
    
    public function login($form){
        $query = $this->prepare('SELECT * FROM users WHERE username=:username AND password=:password LIMIT 1');
        $query->bindParam(':username', $form['username']);
        $query->bindParam(':password', $form['password']);
        $query->execute();
        
        if( $row = $query->fetch(PDO::FETCH_ASSOC) ){
            $this->redis->set(Session::get('new_token'), json_encode($row) );
            $this->redis->expire(Session::get('new_token'), Config::get('database.redis')['expires'] );
            return true;
        } else {
            return false;
        }
    }
    
    
    public function create($form){
        $query = $this->prepare('INSERT INTO users (id,email,username,password,extra,created_at,updated_at) 
        VALUES (null,:email,:uname,:pass,:extra,NOW(),NOW())');
        $query->bindParam(':email', $form['email'] );
        $query->bindParam(':uname', $form['username'] );
        $query->bindParam(':pass', $form['password']);
        $query->bindParam(':extra', $form['extra']);
        return $query->execute();
    }
    
}

?>
