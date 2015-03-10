<?php

use Model\Users;
use App\Session;

Api::get(function($req, $res){
    $run = new Users();
    $input = $req->get(['username', 'password']);
    $test = array_merge( $run->login($input) , ['authToken'=>Session::get('new_token')] );
    $res->status(201)->json($test);
});

Api::error(function($mess , $res){
    
    $res->json(['error']);
    
});

?>