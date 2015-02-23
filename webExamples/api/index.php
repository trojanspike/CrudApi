<?php
require_once __DIR__ . '/../../src/Api.php';

Api::auth(function($request, $response, $run){

    if( $request->get('module') ){
        $api = __DIR__.'/../modules/'.$request->get('module').'/api.php';
        if( file_exists($api) ){
            require_once $api;
            $run();
        } else {
            $response->json([
                'error' => 'true',
                'message' => 'moduleNotFound'
            ]);
        }
    }

});