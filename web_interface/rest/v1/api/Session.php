<?php

use Model\Users;
use app\Session;

/* Create */
Api::post(function($req, $res){
    $User = new Users();

    if( $input = $req->input(['username', 'password']) ){
        if($data = $User->login( $input )){
            $res->json( array_merge($data , ['error'=>false, 'authToken' => Session::get('new_token') ]) );
        } else {
            $res->json(['error'=>true]);
        }
    } else {
        $res->json(['error' => true, 'message' => 'inputError@user/login']);
    }
    
});

/* read / */


/* UPDATE */

/* Destroy */
Api::delete(function($req, $res, $injects){
    /* Auth Token was changed through Auth.php : no need to return it */
    $res->json(['error' => false]); // Error would have been caught in Auth.php
});

Api::error(function($mess, $res){
    $res->status($mess['status'])->json($mess);
});


?>
