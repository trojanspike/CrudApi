<?php

Api::get(function($req, $res){
    $img = path('storage').'/uploads/'.$req->uri; /* GET /v1/ext-image/php.jpg */

    if( file_exists( $img )){
        $res->setContent('image/jpg')->outPut( file_get_contents( $img ) );
    } else {
        $res->html('<h3> Error </h3>');
    }

});