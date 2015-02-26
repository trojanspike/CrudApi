<?php
/*
curl https://basicauthcrud-api-trojanspike.c9.io/api/users/tokenAuth/15/tester/value -H 'Auth-Token:abc123' -H 'accept:application/json'
*/

Api::inject('token', 'abc123');

Api::inject('private', [
    'netWorth' => '£100,000',
    'limited' => true,
    'projectGrowth' => '280% PA'
]);

Api::get(require_once(__DIR__.'/_verbs/get.php'));
Api::post(require_once(__DIR__.'/_verbs/post.php'));
Api::put(require_once(__DIR__.'/_verbs/put.php'));
Api::delete(require_once(__DIR__.'/_verbs/delete.php'));

Api::error(function($message , $res){
    $res->status(500)->json([]);
});

Api::auth(function($req, $res, $run, $injects){
    if( $req->header('auth-token') == $injects['token'] ){
        
        $run();
        
    } else {
        $res->json([
                'error' => 'unauth'    
            ]);
    }
});
?>