<?php

use App\Session;

Api::auth(function($req, $res, $run){
   Session::set('__extra__' , $req->input('__extra__'));

   if( preg_match("/application\/json/", $req->accept) ) {
      $run();
   }

   $res->status(402)->json( ['error' => true, 'message' => ['acceptError'] ] );

});

?>