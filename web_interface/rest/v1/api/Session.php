<?php

use Model\Users;

/* Create */
Api::post(function($req, $res, $injects){
$User = new Users();

    if( $input = $req->input(['username', 'password']) ){
        $User->login( $input, $res, $injects['NEW_TOKEN'] );
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
