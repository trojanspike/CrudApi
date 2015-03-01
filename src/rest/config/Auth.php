<?php

Api::auth(function($req, $res, $run, $injects){
    
    if( $req->get('auth') == $injects['AuthKey'] ){
        $run();
    } else {
        $res->json(['error' => 'AuthRequired']);
    }
    
});

?>