<?php

use Model\Users;
use App\Config;
use App\Session;
use Database\PdoConnect;

Api::get(function($req, $res, $injects){
    //$res->setHeader('Content-Type:text/plain')->outPut(Run::test());
    PdoConnect::sqlite();
    $db = PdoConnect::getHandler();
    
    // $res->json( $db->query('SELECT * FROM token_sessions')->fetchAll(PDO::FETCH_ASSOC) );
    $user_id = $req->get('uid');
    
    $users = $db->prepare('SELECT * FROM users');
    // $users->bindParam('user_id', $user_id);
    $users->execute();
    $r1 = $users->fetchAll(PDO::FETCH_ASSOC);
    
    $token = $db->prepare('SELECT * FROM token_sessions');
    // $token->bindParam('user_id', $user_id);
    $token->execute();
    $r2 = $token->fetchAll(PDO::FETCH_ASSOC);
    
    // $res->json( array_merge( $r1 , $r2 ) );
    
    $User = new Users; // $User->test()
    
   // $res->json( $User->test() );
   $quote = Config::get('demo.quotes');
   
    $res->json( array_merge( $r1, $r2 ) );
});



Api::post(function($req, $res, $injects){
   $res->json( $req->input() );
});

Api::error(function($mess, $res){
   $res->json( $mess );
});


?>