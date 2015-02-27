<?php
require_once __DIR__ . '/../../src/Api.php';
//headerAuth $ curl http://domain.com/headerAuth?module=users -X POST -d '{"key":"val"}' -H 'X-username:user' -H 'X-password:pass' -H 'accept:application/json'
Api::auth(function($request, $response, $run){

    if( $request->header('X-username') == 'user' && $request->header('X-password') == 'pass' ){
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