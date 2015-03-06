<?php

Api::get(function($req, $res){
    
    $res->json(['ok']);
    
});

Api::error(function($req, $res){
    
    $res->json(['error']);
    
});


// URI : GET/ folder-file
?>