<?php

Api::get(function($req, $res){

    $res->setContent('image/jpg')->outPut( file_get_contents( path('storage').'/uploads/php.jpg' ) );

});