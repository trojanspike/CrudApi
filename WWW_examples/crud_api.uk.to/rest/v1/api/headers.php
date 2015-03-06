<?php

api::get(function($req, $res, $injects){
    
    $res->status(200)->setHeader([
        'authToken:'.$injects['NEW_TOKEN'],
        'X-Powered-By',
        'Content-Type:text/html'
        ])->outPut('<h3>Home<h3>');
    
});

?>