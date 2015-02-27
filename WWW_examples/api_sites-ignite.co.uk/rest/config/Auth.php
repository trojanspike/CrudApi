<?php


Api::auth(function($req, $res, $run, $injects){
    $Auth = $req->header(['x-username', 'x-password']);
    if( $Auth ){
        $run();
    } else {
        $res->json(['error' => 'Auth Required']);
    }
});

?>