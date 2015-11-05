<?php
use Database\RedisDB;
use App\Cache;
Api::get(function($req, $res){
    $redis = new RedisDB;
    $res->setContent("application/json")->status(200)->outPut( json_encode( $redis->keys("*") ) );
    $res->json( $redis->keys('*') );
//    $d = json_decode( $redis->get("CACHE-DB-a472185c38bcc7f5499447b545ed8680"), true);
//
//    $res->setContent( $d['contentType'] )->outPut( $d['content'] );

});
