<?php

Api::auth(function($req, $res, $run, $injects){
    /* Good place to put other logic like hit counter */
    $run();
    
});

?>