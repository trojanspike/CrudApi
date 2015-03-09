<?php
/*
curl https://basicauthcrud-api-trojanspike.c9.io/api/web/open/15/tester/value
*/

Api::auth(function($req, $res, $run, $injects){
    $res->json(['get' => $req->get(), $injects]);
});
?>