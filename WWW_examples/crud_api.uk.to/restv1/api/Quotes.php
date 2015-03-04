<?php

use App\Config;

Api::get(function($req, $res, $injects){
    
    // $res->json( $User->test() );
   $quote = Config::get('demo.quotes');
   
   $res->json( ['error'=>false, 'message'=>$quote[rand(0, count($quote))]] );
    
});

Api::error(function($message, $res){
    $res->status( $message['statue'] )->json($message);
});

?>