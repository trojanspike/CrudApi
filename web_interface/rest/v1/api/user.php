<?php

/*
:create,
read,
update
delete
*/


use Model\Users;
use Database\PdoConnect;
use App\Session;

/* # create */
Api::post(function($req, $res, $injects){
    
    $User = new Users();

    if( $req->header('_csrf') && $req->header('_csrf') == Session::get('_CSRF') /*_CSRF*/ ){
        /* Validstion class would be good here */
        if( $input = $req->input(['username', 'password', 'extra']) ){
            $User->create($input, $injects['NEW_TOKEN'], $res);
        } else {
            $res->json(['error' => true, 'message' => 'inputError@user/create']);
        }
    } else {
        $res->json(['error' => true, 'message' => "inputError@user/create#_CSRF-mission"]);
    }
    
});

/* read */

/* update */

/* destroy */

Api::error(function($message, $res){
    $res->unAuth();
});
?>
