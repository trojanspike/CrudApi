<?php
require_once __DIR__ . '/../../src/Api.php';
/* Auth token could be in the DB AuthSessions takes with poss a json data row */
$userInfo = new stdClass;
$userInfo->token = 'tk-1fg5@e45s';
$userInfo->start = time() - ( 60 * 60 );
$userInfo->end = time() + ( 60 * 60 );

Api::inject('Session', $userInfo);

//token $ curl http://domain.com/AUTH_PHP/webExamples/token/ -X GET -H 'Auth-Token:tk-1fg5@e45s' -H 'accept:application/json'
Api::get(function($req, $res, $injects){
    $res->json([
        'input' => $req->input(),
        'injects' => $injects
    ]);
});
//token $ curl http://domain.com/AUTH_PHP/webExamples/token/ -X PUT -H 'Auth-Token:tk-1fg5@e45s' -H 'accept:application/json'
api::put(function($req, $res, $inject){
    $res->json(['verb'=>$req->verb]);
});
Api::auth(function($req, $res, $run, $injects){
    $Session = $injects['Session'];
    if( $token = $req->header('Auth-Token') ){
        if( $token == $Session->token && $Session->end > time() ){
            $run();
        } else {
            $res->status(401)->json([
                'error' => true,
                'message' => 'unAuth'
            ]);
        }
    } else {
        $res->status(401)->json([
            'error' => true,
            'message' => 'unAuth'
        ]);
    }
});