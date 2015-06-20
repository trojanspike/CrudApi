<?php

use App\Config;

Api::get(function($req, $res){

    $res->json( Config::get('mail')[Config::get('mail.default')] );

});