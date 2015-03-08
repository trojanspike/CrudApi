<?php namespace Model\Test;

use Conn\Illuminate;

class Users extends Illuminate {
    
    public function getAll($id){
        
        return $this->table('users')->where('id' , '>', '?', [$id])->get();
        
    }
    
    public function test($id){
        // http://laravel.com/api/4.0/Illuminate/Database/Query/Builder.html
        return $this->table('users')->whereRaw('id > :id', [':id' => $id])->get();
    }
    
}