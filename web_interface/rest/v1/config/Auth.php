<?php


use Model\AuthModel;
use App\Session;

Api::auth(function($req, $res, $run){
    $Auth = new AuthModel(); /* @@@ */

    Session::set('__extra__' , $req->input('__extra__'));

if( preg_match("/application\/json/", $req->accept)  ){

    if($input = $req->header('Auth-token')){
        if( $Auth->byToken($input) ){
            $run();
        } else {
            $res->status(402)->json( ['error' => true, 'message' => ['invalidAuthToken']] );
        }
    }
    else
    {
        $res->status(402)->json( ['error' => true, 'message' => ['noAuthToken'] ] );
    }
    
}

    $res->status(402)->json( ['error' => true, 'message' => ['acceptError'] ] );

});

?>