<?php

use App\Folder\Quotes as Q1;
use Conn\Folder\Quotes as Q2;
use Model\Folder\Quotes as Q3;

use Map;

Api::get(function($req, $res, $injects){
    
    // $map = new Map;
    // $map->run();
    
    // $quotes = new Q1();
   // $quotes = new Q2();
    $quotes = new Q3();
    
    $res->json( $quotes->run() );
    
});

?>