<?php


use App\Security\Auth;
use App\Security\Accepted;
use App\Config;
use App\Build\ResponseAuth as Response;

Api::error(function($message, $res){
    Response::$status = $message['status'];
    Response::run($res, $message);
});

Api::auth(function($req, $res, $run){
    $Auth = new Auth();

    Accepted::$byPass = Config::get('site.debug');

    if( ! Accepted::pass(["/application\/json/"], $req->accept) ){
        $res->status(402)->json( ['error' => true, 'message' => ['acceptError'] ] );
    }


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




});

?>