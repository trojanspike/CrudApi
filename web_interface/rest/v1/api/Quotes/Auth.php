<?php

use App\Config;
use App\Session;

Api::get(function($req, $res, $injects){
    
    $quote = Config::get('demo.quotes');
   
    $res->json( ['error'=>false, 'message'=>$quote[rand(0, count($quote) - 1 )],
    'authToken' => Session::get('new_token')] );
    
});


Api::error(function($message, $res){
    $res->status( $message['statue'] )->json($message);
});

?>