<?php

Api::get(function($req, $res){

    $res->jpg( file_get_contents( path('storage').'/uploads/php.jpg' ) );

});