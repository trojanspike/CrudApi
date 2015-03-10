<?php namespace Model;
// http://laravel.com/api/4.0/Illuminate/Database/Query/Builder.html

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
            return json_decode( $this->redis->get(Session::get('new_token')) , true );
        } else {
            return false;
        }
    }
    
    
    public function create($form){
        $query = $this->prepare('INSERT INTO users (id,username,password,extra) VALUES (null,:uname,:pass,:extra)');
        $query->bindParam(':uname', $form['username'] );
        $query->bindParam(':pass', $form['password']);
        $query->bindParam(':extra', $form['extra']);
        return $query->execute();
    }
    
    private function _createValidate($form){
        return ( strlen($form['username']) > 4 && strlen($form['password']) > 4 )?true:false;
    }
    
    public function test(){
        
        return $this->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}

?>
