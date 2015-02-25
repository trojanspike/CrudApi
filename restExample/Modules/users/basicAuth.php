<?php
require_once __DIR__.'/../../../src/Api.php';

Api::inject('username', '');

Api::get(require_once(__DIR__.'/_verbs/get.php'));
Api::post(require_once(__DIR__.'/_verbs/post.php'));
Api::put(require_once(__DIR__.'/_verbs/put.php'));
Api::delete(require_once(__DIR__.'/_verbs/delete.php'));

Api::error(function($message , $res){
    $res->status(500)->json([]);
});

Api::auth(function($req, $res, $run, $injects){
    $run();
});
?>