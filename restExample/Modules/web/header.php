<?php

Api::auth(function($req, $res, $run, $injects){
    
    
    $res->json( [ 'params' => $injects['params'], 'h-X-Forwarded-For' => $req->header('X-Forwarded-For'), 'h-all' => $req->header(), 'SERVER' => $_SERVER] );
    
});

?>