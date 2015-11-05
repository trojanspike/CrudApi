<?php

use App\Session;
use App\Config;
use App\Build\ResponseApp as Response;

Api::setResponse( new Response(false) );

Api::error(function($message, $res)
{
   Hooks::fire("error:internal", $message);
   $res->status( $message['status'] )->json($message);
});

Api::auth(function($req, $res, $run)
{
   Session::set('__extra__' , $req->input('__extra__'));
   Hooks::fire("init:start", [$req, $res, $_SERVER['REMOTE_ADDR']]);
   $run();
});
