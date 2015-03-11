<?php

use Database\RedisDB;
$id = 123;
/* TODO - quick storage over /POST , retrieve /GET */
Api::get(function($req, $res) use($id) {
    $redis = new RedisDB;

    $params = $req->params(2);

    $res->setContent('application/json')->outPut( $redis->get($id.'_'.$params[0]) );

});

Api::post(function($req, $res) use($id) {
    $redis = new RedisDB;
    $params = $req->params(2);

    $redis->set($id.'_'.$params[0], json_encode( $req->input() ) );
    $redis->expire($id.'_'.$params[0], $params[1]);

    $res->json( $id.'_'.$params[0] );

});


?>