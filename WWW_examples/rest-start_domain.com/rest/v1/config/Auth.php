<?php
// curl -H 'accept:application/json' http://domsin.com/v1/exampleAuth?auth=access -X POST 
Api::auth(function($req, $res, $run, $injects){
    
        // AuthKey defined in ./Injects
    if( $req->get('auth') == $injects['AuthKey'] ){
        // ask if uri?auth=access : $run request
        // /POST , /PUT , DELETE
        $run();
    } else {
        $res->json(['error' => 'AuthRequired']);
    }
    
});

?>