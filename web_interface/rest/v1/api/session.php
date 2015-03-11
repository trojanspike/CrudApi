<?php

use Model\Users;
use app\Session;

/* Create */
Api::post(function($req, $res){
    $User = new Users();
    $res->json( Session::get() );
    if( $input = $req->input(['username', 'password']) ){
        if( $User->login( $input )){
            $res->json( ['error'=>false, 'authToken' => Session::get('new_token') ] );
        } else {
            $res->json(['error'=>true, 'message' => ['userNotFound'] ]);
        }
    } else {
        $res->json( ['error' => true, 'message' => ['inputError'] ]);
    }
    
});

/* read / */


/* UPDATE */

/* Destroy */
Api::delete(function($req, $res){

    /* Remove key from Redis */
    $res->json(['error' => false]); // Error would have been caught in Auth.php
});

Api::error(function($mess, $res){
    $res->status($mess['status'])->json($mess);
});


?>
