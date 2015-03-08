<?php

use Conn\Illuminate;

use Model\Test\Users;

Api::get(function($req, $res, $injects){
    
    $db = new Illuminate;
    $result = $db::table('users')->get();
    
   /* */
    $users = new Users;

    $result2 = $users->test($injects['PARAMS'][0]);
    // $result2 = $users::table('users')->get();
    
     
    $res->json($result2);
    
    
});