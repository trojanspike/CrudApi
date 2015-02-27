<?php


Api::auth(function($req, $res, $run, $injects){
    
    if( $req->accept !== 'application/json' && $req->verb === 'GET' ){
        switch( $injects['API'] ){
            case 'user':
                $res->json([
                    'inject' => $injects
                    ]);
            break;
            default:
                $res->json([]);        
        }
    } else {
        $run();
    }
});

?>