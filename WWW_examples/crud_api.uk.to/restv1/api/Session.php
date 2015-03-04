<?php

use Conn\Auth;
use Model\Users;
/* Create */
Api::post(function($req, $res, $injects){
$User = new Users();
// curl -H 'accept:application/json' http://http://crud-api.uk.to/v1/Session -X POST -d '{"username":"trojanspike", "password":"password"}'
        /* _csrf isnt needed , users can remote login for API access */
        /* track login try amounts - block @ 5 in an hour */
    if( $input = $req->input(['username', 'password']) ){
        $User->login( $input, $res, $injects['NEW_TOKEN'] );
    } else {
        $res->json(['error' => true, 'message' => 'inputError@user/login']);
    }
    
});

/* read / return all sessions */
Api::get(function($req, $res, $injects){
    $res->json(['##'.__FILE__]);
});


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
