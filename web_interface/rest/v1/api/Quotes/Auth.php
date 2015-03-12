<?php

use App\Build\ResponseAuth as Response;
use App\Session;
use App\Config;

Api::get(function($req, $res, $injects){
    
    $quote = Config::get('demo.quotes');

    Response::add(['error'=>false, 'message'=>$quote[rand(0, count($quote) - 1 )]]);
    Response::run($res);
    
});

?>
