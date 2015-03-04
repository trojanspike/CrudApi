<?php namespace App;

class Session {
    
    
    public static function start(){
        if( ! isset( $_SESSION['_CSRF'] ) ){
            $_SESSION['_CSRF'] = hash( 'tiger128,4' , uniqid());
        }
    }
    
    
    public static function get($key){
        return isset( $_SESSION[$key] )?$_SESSION[$key]:false;
    }
    
    
}

?>