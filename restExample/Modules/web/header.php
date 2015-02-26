<?php

Api::auth(function($req, $res, $run, $injects){
    
    
    $res->json( [ 'params' => $injects['params'], 'h-X-region' => $req->header('X-region'), 'h-all' => $req->header(), 'SERVER' => $_SERVER] );
    
});

?>