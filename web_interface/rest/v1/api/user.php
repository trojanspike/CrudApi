<?php

/*
:create,
read,
update
delete
*/


use Model\Users;
use App\Session;

/* # create */
Api::post(function($req, $res, $injects){
    
    $User = new Users();

    if( $req->header('_csrf') && $req->header('_csrf') == Session::get('_CSRF') /*_CSRF*/ ){
        /* Validstion class would be good here */
        if( $input = $req->input(['username', 'password', 'extra']) ){
            $result = $User->create($input);
            $res->json( array_merge( $result , ['authToken' => Session::get('new_token')] ) );
        } else {
            $res->json(['error' => true, 'message' => 'inputError@user/create']);
        }
    } else {
        $res->json(['error' => true, 'message' => "inputError@user/create#_CSRF-mission"]);
    }
    
});

/* read */

Api::get(function($req, $res){
    
    $User = new Users();

    if( true ){
        /* Validstion class would be good here */
        if( $input = $req->get(['username', 'password', 'extra']) ){
            if( $User->create($input) ){
                $res->created();
            } else {
                $res->status(500)->json(['error'=>true, 'message'=>'serverError']);
            }
        } else {
            $res->json(['error' => true, 'message' => 'inputError']);
        }
    } else {
        $res->json(['error' => true, 'message' => "inputError"]);
    }
    
});

/* update */

/* destroy */

Api::error(function($message, $res){
    $res->unAuth();
});
?>
