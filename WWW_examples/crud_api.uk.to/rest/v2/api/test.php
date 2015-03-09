<?php
use Database\Illuminate;
use App\Config;

Api::get(function($req, $res, $injects){
    
    $DB = new Illuminate;
    $result = $DB::table('users')->get();
    $res->json($result);
    
});



Api::post(function($req, $res, $injects){
   $res->json( $req->input() );
});

?>