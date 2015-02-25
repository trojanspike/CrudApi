<?php

return function($req, $res, $injects){
    $injects['PublicData']['PUTS'] = $req->input();
    $res->json(['verb' => 'PUT',
        'PublicData' => $injects['PublicData']
    ]);
}

?>