<?php


Api::get(function($req, $res, $injects){
    $res->json([
        'file' => __FILE__,
        'verb' => $req->verb,
        'get' => $req->get(),
        'injects' => $injects
        ]);
});

Api::post(function($req, $res, $injects){
    // no auth you might want to check that there is CSRF
    // if( $req->input('_csrf') == $_SESSION['csrf'] ) for example
    $res->json([
        'file' => __FILE__,
        'verb' => $req->verb,
        'input' => $req->input(),
        'injects' => $injects
        ]);
});


Api::put(function($req, $res, $injects){
    $message = 'Default Message';
    
    if( $input = $req->input(['csrf', 'update', 'message']) ){
        $message = $input[2];
        $res->json([
            'input' => $req->input(),
            'message' => $message.' ## '.$input[1]
        ]);
    } else {
        $res->json(['error' => true]);
    }
});


Api::delete(function($req, $res, $injects){
    if( ! $req->input('csrf') ){
        $res->unAuth();
    } else {
        $res->ok();
    }
});

Api::error(function($message, $res){
    $res->status($message['status'])->json($message);
});

?>