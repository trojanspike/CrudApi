<?php

use App\Auth;

Api::auth(function($req, $res, $run, $injects){
    $Auth = new Auth();
 // curl -H 'accept:application/json' http://api.sites-ignite.co.uk/v1/user -X GET -H 'auth-token:abc123'   
    
/*
if( preg_match("/application\/json/", $req->sccept) ){
    
    
}   
*/
    if($input = $req->header('Auth-token')){
        if( $Auth->byToken($input, $injects['NEW_TOKEN']) > 0 ){
            $run();
        } else {
            $res->json( ['error' => true, 'message' => 'invalidAuthToken'] );
        }
    }
    
    $res->json( ['error' => true, 'message' => 'noAuthToken'] );

});

?>