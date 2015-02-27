<?php

return function($req, $res, $injects){
    $res->json([
        'file' => __FILE__,
        'verb' => $req->verb,
        'get' => $req->get(),
        'input' => $req->input(),
        'header' => $req->header(),
        'basic' => $req->basicAuth(),
        'injects' => $injects    
    ]);
}

?>