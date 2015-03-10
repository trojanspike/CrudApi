<?php namespace Model;

use Database\RedisDB;

class AuthModel extends RedisDB {
    
    public function test(){
        $this->set('x','v');
        return $this->get('x');
    }
    
}

?>