<?php


use Model\Auth;

Api::auth(function($req, $res, $run, $injects){
    $Auth = new Auth(); 
    

if( preg_match("/application\/json/", $req->accept) ){
    
    if($input = $req->header('Auth-token')){
        if( $Auth->byToken($input, $injects['NEW_TOKEN']) > 0 ){
            $run();
        } else {
            $res->json( ['error' => true, 'message' => 'invalidAuthToken'] );
        }
    }
    
}
    
    $res->json( ['error' => true, 'message' => 'noAuthToken'] );

});

?>