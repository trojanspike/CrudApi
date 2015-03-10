<?php


use Model\AuthModel;

Api::auth(function($req, $res, $run){
    $Auth = new AuthModel(); 
    

if( preg_match("/application\/json/", $req->accept) ){
    
    $res->json( $Auth->test() );
    if($input = $req->header('Auth-token')){
        if( $Auth->byToken($input) ){
            $run();
        } else {
            $res->json( ['error' => true, 'message' => 'invalidAuthToken'] );
        }
    }
    
}
    
    $res->json( ['error' => true, 'message' => 'noAuthToken'] );

});

?>