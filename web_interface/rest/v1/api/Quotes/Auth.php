<?php

use App\Session;
use App\Config;


Api::get(function($req, $res) {
    
    $quote = Config::get('demo.quotes');

    $res->json(['error'=>false, 'message'=>$quote[rand(0, count($quote) - 1 )]]);
    
});
