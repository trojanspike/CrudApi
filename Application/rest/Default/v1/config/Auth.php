<?php


use App\Security\Auth;
use App\Security\Accepted;
use App\Config;
use App\Build\ResponseApp as Response;
use App\Session;
/* Generate a new token */
Session::set('new_token', AuthTokenGenerate());
/***********************/

Api::setResponse( new Response(true) );

Api::error(function($message, $res)
{
    $res->json($message);
});

Api::auth(function($req, $res, $run){
    Hooks::fire('auth:before', [ $_SERVER['REMOTE_ADDR'] ]);

    Accepted::$byPass = Config::get('site.debug'); /* TODO - not needed , remove */

    if( ! Accepted::pass(["/application\/json/"], $req->accept) )
    {
        Hooks::fire('auth:fail', [ $_SERVER['REMOTE_ADDR'] ]);
        $res->status(400)->json( ['error' => true, 'message' => ['acceptError'] ] );
    }


    if($input = $req->header('Auth-token'))
    {
        $Auth = new Auth();
        if( $Auth->byToken($input) )
        {
            Hooks::fire('auth:success', [ $_SERVER['REMOTE_ADDR'] ]);
            $run();
        }
        else
        {
            Hooks::fire('auth:fail', [ $_SERVER['REMOTE_ADDR'] ]);
            $res->status(401)->json( ['error' => true, 'message' => ['invalidAuthToken']] );
        }
    }
    else
    {
        Hooks::fire('auth:fail', [ $_SERVER['REMOTE_ADDR'] ]);
        $res->status(401)->json( ['error' => true, 'message' => ['noAuthToken'] ] );
    }

});