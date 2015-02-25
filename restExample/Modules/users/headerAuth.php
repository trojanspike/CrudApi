<?php
/*
curl https://basicauthcrud-api-trojanspike.c9.io/api/users/headerAuth/15/tester/value -H 'x-username:user123' -H 'x-password:pass123' -H 'accept:application/json'

*/
require_once __DIR__.'/../../../src/Api.php';

Api::inject('username', 'user123');
Api::inject('password', 'pass123');
Api::inject('token', 'abc123');

Api::get(require_once(__DIR__.'/_verbs/get.php'));
Api::post(require_once(__DIR__.'/_verbs/post.php'));
Api::put(require_once(__DIR__.'/_verbs/put.php'));
Api::delete(require_once(__DIR__.'/_verbs/delete.php'));

Api::error(function($message , $res){
    $res->status(500)->json([]);
});

Api::auth(function($req, $res, $run, $injects){
    if( $req->header('x-username') == $injects['username'] && $req->header('x-password') == $injects['password'] ){
        $run();
    } else {
        $res->unAuth();
    }
});
?>