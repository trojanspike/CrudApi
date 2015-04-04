<?php

Api::get(function($req, $res){
    $func = '';
    $res->json([ is_callable($func) ]);

});

Api::post(function(){

    Hooks::fire('test');

});