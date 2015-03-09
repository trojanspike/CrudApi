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
    if( $req->input('csrf') == $_SESSION['_CSRF'] ){
        $res->json([
            'file' => __FILE__,
            'verb' => $req->verb,
            'input' => $req->input(),
            'injects' => $injects
        ]);
    } else {
        $res->json(['error' => true]);
    }
});


Api::put(function($req, $res, $injects){
    $res->json([
        'file' => __FILE__,
        'verb' => $req->verb,
        'input' => $req->input(),
        'injects' => $injects
        ]);
});


Api::delete(function($req, $res, $injects){
    $res->json([
        'file' => __FILE__,
        'verb' => $req->verb,
        'header' => $req->header(),
        'injects' => $injects
        ]);
});

Api::error(function($message, $res){
    $res->status($message['status'])->json($message);
});

?>