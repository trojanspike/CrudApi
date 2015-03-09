<?php

use Model\Test\Users;

Api::get(function($req, $res){
    $users = new Users;
    $params = $req->params();
    $res->json( $users->getRange($params[0],$params[1]) );
    
});


?>