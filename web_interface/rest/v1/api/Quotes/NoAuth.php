<?php

use App\Config;

Api::get(function($req, $res){
    
    // $res->json( $User->test() );
   $quote = Config::get('demo.quotes');
   
   $res->json( ['error'=>false, 'message'=>$quote[rand(0, count($quote) - 1 )]] );
    
});

?>