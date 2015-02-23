<?php
//api $ curl http://domain.com/api?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json'
//auth $ curl -u user:pass http://domain.com/auth?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json'
Api::post(function($req, $res){
    $res->json([
        'input' => $req->input()
    ]);
});

//api $ curl http://domain.com/api?module=users -H 'accept:application/json'
//auth $ curl -u user:pass http://domain.com/auth?module=users -H 'accept:application/json'
Api::get(function($req, $res){
    $res->json([['id' => 1, 'name' => 'pete', 'job' => 'security'],
        ['id' => 2,'name' => 'John', 'job' => 'care taker'],
        ['id' => 3,'name' => 'jane', 'job' => 'assistant']]);
});

//api $ curl http://domain.com/api?module=users -X PUT -d '{"key":"val"}' -H 'accept:application/json'
//auth $ curl -u user:pass http://domain.com/auth?module=users -X PUT -d '{"key":"val"}' -H 'accept:application/json'
Api::put(function($req, $res){
    $res->json([
        'verb' => $req->verb,
        'input' => $req->input()
    ]);
});

//api $ curl http://domain.com/api?module=users?id=2 -H 'accept:application/json'
//auth $ curl -u user:pass http://domain.com/auth?module=users?id=2 -H 'accept:application/json'
Api::delete(function($req, $res){
    $res->json([
        'verb' => $req->verb,
        'id' => $req->get('id')
    ]);
});

//api $ curl http://domain.com/api?module=users -X POST -d '{"key":"val"}' -H 'accept:application/text'
//auth $ curl -u user:pass http://domain.com/auth?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json'
Api::error(function($message, $res){
    $res->status($message['status'])->json($message);
});