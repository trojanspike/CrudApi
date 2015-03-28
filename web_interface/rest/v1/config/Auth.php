<?php


use App\Security\Auth;
use App\Security\Accepted;
use App\Config;
use App\Build\ResponseAuth as Response;

Api::setResponse( new Response );

Api::error(function($message, $res)
{
    $res->json($message);
});

Api::auth(function($req, $res, $run){
    $Auth = new Auth();

    Accepted::$byPass = Config::get('site.debug'); /* TODO - not needed , remove */

    if( ! Accepted::pass(["/application\/json/"], $req->accept) )
    {
        $res->status(400)->json( ['error' => true, 'message' => ['acceptError'] ] );
    }


    if($input = $req->header('Auth-token'))
    {
        if( $Auth->byToken($input) )
        {
            $run();
        }
        else
        {
            $res->status(401)->json( ['error' => true, 'message' => ['invalidAuthToken']] );
        }
    }
    else
    {
        $res->status(401)->json( ['error' => true, 'message' => ['noAuthToken'] ] );
    }

});