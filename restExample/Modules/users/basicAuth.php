<?php

/*
curl -u user123:pass123 https://basicauthcrud-api-trojanspike.c9.io/api/users/basicAuth/15/tester/value -H 'accept:application/json'
*/


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
    if( $req->basicAuth('username') == $injects['username'] && $req->basicAuth('password') == $injects['password'] ){
        $run();
    } else {
        $req->unAuth();
    }
});
?>