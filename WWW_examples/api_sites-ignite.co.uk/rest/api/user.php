<?php

/*
:create,
read,
update
delete
*/
/* $res, $res, $injects['params'] */
Api::post();


Api::get(function($req, $res, $injects){
    $res->json(['name' => 'Lee', 'injects' => $injects]);
});


Api::put();
Api::delete();

?>