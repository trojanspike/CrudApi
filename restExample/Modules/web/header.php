<?php

Api::auth(function($req, $res, $run, $injects){
    
    
    $res->json( [ 
        'params' => $injects['params'], 
        'has-getAllHeader' => function_exists('getallheaders'),
        'h-X-Forwarded-For' => $req->header('X-Forwarded-For'), 
        'h-all' => $req->header(), 
        'SERVER' => $_SERVER] );
    
});

?>