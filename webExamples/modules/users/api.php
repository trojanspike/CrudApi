<?php
//api $ curl http://polar-dawn-5134.herokuapp.com/api -X POST -d '{"key":"val"}' -H 'accept:application/json'
//auth $ curl http://user:pass@polar-dawn-5134.herokuapp.com/auth -X POST -d '{"key":"val"}' -H 'accept:application/json'
Api::post(function($req, $res){
    $res->json([
        'input' => $req->input()
    ]);
});

//api $ curl http://polar-dawn-5134.herokuapp.com/api -H 'accept:application/json'
//auth $ curl http://user:pass@polar-dawn-5134.herokuapp.com/auth -H 'accept:application/json'
Api::get(function($req, $res){
    $res->json([['id' => 1, 'name' => 'pete', 'job' => 'security'],
        ['id' => 2,'name' => 'John', 'job' => 'care taker'],
        ['id' => 3,'name' => 'jane', 'job' => 'assistant']]);
});

//api $ curl http://polar-dawn-5134.herokuapp.com/api -X PUT -d '{"key":"val"}' -H 'accept:application/json'
//auth $ curl http://user:pass@polar-dawn-5134.herokuapp.com/auth -X PUT -d '{"key":"val"}' -H 'accept:application/json'
Api::put(function($req, $res){
    $res->json([
        'verb' => $req->verb,
        'input' => $req->input()
    ]);
});

//api $ curl http://polar-dawn-5134.herokuapp.com/api?id=2 -H 'accept:application/json'
//auth $ curl http://user:pass@polar-dawn-5134.herokuapp.com/auth?id=2 -H 'accept:application/json'
Api::delete(function($req, $res){
    $res->json([
        'verb' => $req->verb,
        'id' => $req->get('id')
    ]);
});

//api $ curl http://polar-dawn-5134.herokuapp.com/api -X POST -d '{"key":"val"}' -H 'accept:application/text'
//auth $ curl http://user:wrongpass@polar-dawn-5134.herokuapp.com/auth -X POST -d '{"key":"val"}' -H 'accept:application/json'
Api::error(function($message, $res){
    $res->status($message['status'])->json($message);
});