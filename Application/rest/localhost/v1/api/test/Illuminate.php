<?php
use Database\Illuminate;

Api::get(function($req, $res){

    $db = new Illuminate();


    $users = $db::table('users')->get();
    $res->json($users);

});