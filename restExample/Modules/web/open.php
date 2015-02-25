<?php
/*
curl https://basicauthcrud-api-trojanspike.c9.io/api/web/open/15/tester/value
*/
require_once __DIR__.'/../../../src/Api.php';

Api::auth(function($req, $res, $run, $injects){
    $res->json($injects);
});
?>