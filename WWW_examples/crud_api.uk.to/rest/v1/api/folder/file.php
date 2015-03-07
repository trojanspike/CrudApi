<?php

use App\Session as Sess;

Api::get(function($req, $res){

    Sess::set('test', uniqid());
    
    $res->json( $_SESSION );
    
});




Api::error(function($req, $res){
    
    $res->json(['error']);
    
});


// URI : GET/ folder-file
?>