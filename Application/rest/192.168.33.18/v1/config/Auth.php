<?php


use App\Security\Auth;
use App\Config;
use App\Build\ResponseApp as Response;
use App\Session;

/***********************/
Session::set('new_token', AuthTokenGenerate());
Api::setResponse( new Response(true) );

Api::error(function($message, $res)
{
    Hooks::fire("error:internal", $message);
    $res->json($message);
});

Api::auth(function($req, $res, $run){
    Hooks::fire("init:start", [$req, $res, $_SERVER['REMOTE_ADDR']]);
    Hooks::fire('auth:before', [$req, $res, $_SERVER['REMOTE_ADDR']]);

    if($input = $req->header('Auth-token'))
    {
        $Auth = new Auth();
        if( $Auth->byToken($input) )
        {
            Hooks::fire('auth:success', [$req, $res, $_SERVER['REMOTE_ADDR']]);
            $run();
        }
        else
        {
            Hooks::fire('auth:fail', [$req, $res, $_SERVER['REMOTE_ADDR']]);
            $res->status(401)->json( ['error' => true, 'message' => ['invalidAuthToken']] );
        }
    }
    else
    {
        Hooks::fire('auth:fail', [$req, $res, $_SERVER['REMOTE_ADDR']]);
        $res->status(401)->json( ['error' => true, 'message' => ['noAuthToken'] ] );
    }

});