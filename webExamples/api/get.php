<?php
require_once __DIR__ . '/../../src/Api.php';

Api::auth(function($request, $response, $run){
    if( $request->verb == 'GET' ){
        $response->json(
            [
                'get' => $request->get(),
                'input' => $request->input(),
                'header' => $request->header(),
                'SERVER' => $_SERVER
            ]
        );
    }
});