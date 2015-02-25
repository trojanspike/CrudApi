<?php
/*
curl https://basicauthcrud-api-trojanspike.c9.io/api/users/tokenAuth/15/tester/value -H 'Auth-Token:abc123' -H 'accept:application/json'
*/
require_once __DIR__.'/../../../src/Api.php';

Api::inject('token', 'abc123');

Api::get(require_once(__DIR__.'/_verbs/get.php'));
Api::post(require_once(__DIR__.'/_verbs/post.php'));
Api::put(require_once(__DIR__.'/_verbs/put.php'));
Api::delete(require_once(__DIR__.'/_verbs/delete.php'));

Api::error(function($message , $res){
    $res->status(500)->json([]);
});

Api::auth(function($req, $res, $run, $injects){
    if( $token = $req->header('auth-token') ){
        
        if( $token == $injects['token'] ){
            $run();
        } else {
            $res->status(401)->json([
                'error' => 'unauth2'    
            ]);
        }
        
    } else {
        $res->status(401)->json($req->header());
    }
});
?>