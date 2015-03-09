<?php

use Database\RedisDB;
use App\Session;

Api::get(function($req, $res){
    $key = $req->get('key');
    $DB = new RedisDB;
    // $DB->set($key, json_encode(['name'=>'Lee']) );
    Session::set('old_key', $key);
    if( $userData = $DB->get( $key ) ){
        Session::set('user', json_decode($userData));
        Session::set('new_key', uniqid());
        // $DB->rename($key, $key.'L');
        
        $res->json( Session::get() );
    } else {
        $res->json(['err']);
    }
    
    // KEY#md5( uniqid() ) = value
    // $DB->set($key, json_encode(['name'=>'Lee', 'age'=>'32']) );
    
    exit();
    
});

?>