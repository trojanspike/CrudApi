<?php
use Database\RedisDB;

Api::get(function($req, $res){
    $redis = new RedisDB;

    $res->json( $redis->keys('*') );
    //- $res->setContent('application/json')->outPut( $redis->get("ec7c076d6cdc4231a8eeb3cdf27d55f1df15ea6682e7a4aee243db3c") );

});
