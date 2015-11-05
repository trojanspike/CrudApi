<?php

use App\Config;

Api::get(function($req, $res){

    $res->json( array_merge_recursive( Config::get('mail') , Config::get('path'), Config::get('site'), Config::get('database') ) );

});