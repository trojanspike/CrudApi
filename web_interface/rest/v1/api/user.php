<?php

/*
:create,
read,
update
delete
*/


use Model\Users;
use App\Session;
use App\Config;


/* # create */
Api::post(function($req, $res, $injects){
    
    $User = new Users();

/* */  if( $req->header('_csrf') && $req->header('_csrf') == Session::get('_CSRF') ){
        /* Validstion class would be good here */
        
        if( $input = $req->input(['username', 'email', 'password', 'extra']) ){
            
             if($User->create($input)){
                 $res->json(['error'=>false]);
            } else {
              $res->json(['error' => true, 'message' => 'Error@user/create']);
            }
        } else {
            // error
            $res->json(['error'=>true, 'message'=>'validation']);
        }
/* */ }
    $res->json(['error' => true, 'message' => "missingCsrf"]);    
});

/* read */
use Database\Illuminate;

Api::get(function($req, $res){
    $db = new Illuminate;
    $db->table('users')->insert([
        'username' => '"\Someuser',
        'password' => 'ppaass/',
        'email' => 'EEMMAIL"'
        ]);
    
    $result = $db->table('users')->get();
    $res->json( $result );
});

/* update */

/* destroy */

Api::error(function($message, $res){
    $res->unAuth();
});
?>
