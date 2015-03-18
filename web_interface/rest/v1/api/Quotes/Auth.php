<?php

use App\Build\ResponseAuth as Response;
use App\Session;
use App\Config;

$res = new Response;

Api::get(function($req) use($res) {
    
    $quote = Config::get('demo.quotes');

    $res->json(['error'=>false, 'message'=>$quote[rand(0, count($quote) - 1 )]]);
    
});

?>
