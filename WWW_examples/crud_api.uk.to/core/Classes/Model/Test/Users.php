<?php namespace Model\Test;

use Conn\Illuminate;

class Users extends Illuminate {
    
    public function getAll(){
        
        return $this->table('users')->get();
        
    }
    
    public function test($from=0, $to=false){
         // http://laravel.com/api/4.0/Illuminate/Database/Query/Builder.html
        $query = $this->table('users');;
        $query->whereRaw('id > :from', [':from'=>$from]);
        if( $to ){
            $query->whereRaw('id <= :to', [':to'=>$to]);
        }
        return $query->get();
    }
    
}