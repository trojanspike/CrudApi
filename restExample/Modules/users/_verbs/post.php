<?php

return function($req, $res, $injects){
    $res->json([
        'get' => $req->get(),
        'input' => $req->input(),
        'header' => $req->header(),
        'basic' => $req->basicAuth(),
        'injects' => $injects    
    ]);
}

?>