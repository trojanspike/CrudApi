<?php

Api::auth(function($req, $res, $injects){
    
    if( $req->get('auth') == $injects['AuthKey'] ){
        $run();
    } else {
        $res->json(['error' => 'AuthRequired']);
    }
    
});

?>