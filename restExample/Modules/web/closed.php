<?php
require_once __DIR__.'/../../../src/Api.php';

Api::get(function($req, $res, $injects){
    $res->json( $injects );
});

Api::error(function($mess, $res){
    $res->notFound();
});

Api::auth(function($req, $res, $run, $injects){
    $run();
});
?>