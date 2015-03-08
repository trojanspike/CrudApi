<?php


Api::auth(function($req, $res, $run, $injects){
    /* if no $req->header('auth-token')
        check for $req->header or input ('_csrf')
        
        Just for example letting it in
    */
    // $get = $req->get(['key','key1','key2']);
   // $res->json( $get['key'] );
    
    
    
    $run();
});

?>