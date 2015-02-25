<?php

return function($req, $res, $injects){
    $res->json(['verb' => 'GET',
        'PublicData' => $injects['PublicData']
    ]);
}

?>