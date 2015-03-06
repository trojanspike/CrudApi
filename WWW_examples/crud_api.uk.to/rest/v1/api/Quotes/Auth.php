<?php

use App\Config;

Api::get(function($req, $res, $injects){
    
    $quote = Config::get('demo.quotes');
   
    $res->json( ['error'=>false, 'message'=>$quote[rand(0, count($quote))],
    'authToken' => $injects['NEW_TOKEN']] );
    
});


Api::error(function($message, $res){
    $res->status( $message['statue'] )->json($message);
});

?>