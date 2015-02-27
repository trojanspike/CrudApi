<?php

Api::get(function($req, $res, $injects){
    
    $res->json(['dir' => __DIR__]);
    
});

Api::error(function($req, $res, $injects){
    
    $res->json(['error' => true]);
    
});

?>