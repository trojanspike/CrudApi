<?php

return function($req, $res, $injects){
    $res->json(['verb' => 'DELETE',
    '   get' => $req->get(),
        'PublicData' => $injects['PublicData']
    ]);
}

?>