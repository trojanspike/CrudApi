<?php
require_once __DIR__ . '/../../src/Api.php';
$userInfo = new stdClass;
$userInfo->name = 'John';
$userInfo->gender = 'Male';
$userInfo->job = 'Care Taker';
Api::inject('user', $userInfo);

//auth $ curl -u user:pass http://domain.com/auth?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json'
//auth $ curl -u user:pass http://domain.com/auth?module=injects -X PUT -d '{"job":"Security"}' -H 'accept:application/json'

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