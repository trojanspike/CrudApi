<?php
require_once __DIR__.'/../../../src/Api.php';

Api::auth(function($req, $res, $run, $injects){
    $res->json($injects);
});
?>