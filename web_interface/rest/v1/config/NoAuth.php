<?php

use App\Session;
use App\Config;

Api::auth(function($req, $res, $run){
   Session::set('__extra__' , $req->input('__extra__'));

   if( Config::get('site.debug') ){
      $run();
   }

   if( preg_match("/application\/json/", $req->accept) ) {
      $run();
   }

   $res->status(402)->json( ['error' => true, 'message' => ['acceptError'] ] );

});

?>