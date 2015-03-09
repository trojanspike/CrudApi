<?php
/*
curl https://basicauthcrud-api-trojanspike.c9.io/api/web/closed/15/tester/value -H 'accept:application/json'
*/

Api::get(function($req, $res, $injects){
    $res->json( ['api' => 'web/closed - closed from viewing on web', 'injects' => $injects] );
});

Api::error(function($mess, $res){
    $res->notFound();
});

Api::auth(function($req, $res, $run, $injects){
    $run();
});
?>