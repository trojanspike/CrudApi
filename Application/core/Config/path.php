<?php

return [

    'www'               => realpath(__DIR__.'/../../www/'),

    'storage'           => realpath(__DIR__.'/../Storage/'),

    'schema'            => realpath( __DIR__.'/../Classes/Schema/' ),

    "config"            => realpath( __DIR__."/../Config/" ),

    "base"              => realpath( __DIR__."/../../" ),

    "js_dirs"           =>  [__DIR__.'/../../www/app', __DIR__.'/../../www/app/pages'],

    "bowerFile"         =>  false // __DIR__."/../../www/app/bower.json"
];
