<?php

Api::get(function($req, $res){
    $js = <<<EFO
(function(){
    window.onload = function(){
        console.log("Loaded");
    }
})();
EFO;

    $res->setContent('application/javascript')->outPut( $js );

});