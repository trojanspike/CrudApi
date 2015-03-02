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