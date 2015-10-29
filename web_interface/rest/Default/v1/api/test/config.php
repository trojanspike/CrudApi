<?php

use App\Config;

Api::get(function($req, $res){

    $res->json( array_merge( Config::get('mail') , Config::get('path') ) );

});