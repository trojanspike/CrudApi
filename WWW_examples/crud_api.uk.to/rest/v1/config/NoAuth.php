<?php


Api::auth(function($req, $res, $run, $injects){
    /* if no $req->header('auth-token')
        check for $req->header or input ('_csrf')
        
        Just for example letting it in
    */
    
    $run();
});

?>