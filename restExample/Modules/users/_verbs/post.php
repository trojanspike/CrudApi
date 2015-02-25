<?php

return function($req, $res, $injects){
    $res->json(['verb' => 'POST',
        'input' => $req->input(),
        'PublicData' => $injects['PublicData']
    ]);
}

?>