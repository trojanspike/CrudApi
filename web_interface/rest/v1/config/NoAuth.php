<?php

use App\Session;
use App\Config;
use App\Security\Accepted;

Api::error(function($message, $res){
   $res->status( $message['status'] )->json($message);
});

Api::auth(function($req, $res, $run){
   Session::set('__extra__' , $req->input('__extra__'));

   Accepted::$byPass = Config::get('site.debug');


   if( ! Accepted::pass(["/application\/json/"], $req->accept) ){
      $res->status(402)->json( ['error' => true, 'message' => ['acceptError'] ] );
   } else {
      $run();
   }

});

?>