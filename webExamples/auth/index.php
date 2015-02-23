<?php
require_once __DIR__ . '/../../src/Api.php';

Api::auth(function($request, $response, $run){

    if( $request->basicAuth('username') == 'user' && $request->basicAuth('password') == 'pass' ){
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
    } else {
        $response->status(401)->json([
            'error' => 'true',
            'message' => 'unAuth'
        ]);
    }
});