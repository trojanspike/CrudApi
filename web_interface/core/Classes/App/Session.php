<?php namespace App;

class Session {
    
	public function __get($key){
		return ( isset( $_SESSION[$key] ) )?$_SESSION[$key]:false;
	}

	public function __set($key, $val){
		$_SESSION[$key] = $val;
	}
    
    public static function start(){
        if( ! isset( $_SESSION['_CSRF'] ) ){
            $_SESSION['_CSRF'] = hash( 'tiger128,4' , uniqid());
        }
    }
    
    
    public static function get($key=false){
        if($key){
            return isset( $_SESSION[$key] )?$_SESSION[$key]:false;
        } else {
            return $_SESSION;
        }
    }
    
    public static function set($key, $val){
        $_SESSION[$key]=$val;
    }
    
    
}

?>
