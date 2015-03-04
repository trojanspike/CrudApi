<?php

/*
:create,
read,
update
delete
*/
/* $res, $res, $injects['params'] */

use Model\Users;
use conn\Database;
use App\Session;

/* # crearte */
Api::post(function($req, $res, $injects){
    
    $User = new Users();

// curl -H 'accept:application/json' http://http://crud-api.uk.to/v1/user -X POST -d '{"_csrf":"abc123", "username":"trojanspike", "password":"passord", "extra":"some extra info"}'
    /* poss conflict - Sess::get return null if empty , header return false */
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

/* create */
api::get(function($req, $res, $injects){
    $db = Database::getHandler();
    
    $result = $db->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    $res->json( $result );
});

/* update */

/* destroy */

Api::error(function($message, $res){
    $res->unAuth();
});
?>
