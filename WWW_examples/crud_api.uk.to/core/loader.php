<?php
use App\Config;

foreach (glob(__DIR__."/Classes/**/*.php") as $class) {
    require_once $class;
}


foreach (glob(__DIR__."/Config/*.php") as $file) {
    /* Lets not clash with any other possible globals */
    $GLOBALS[ Config::GetId() .'_'. strtoupper(  pathinfo($file , PATHINFO_FILENAME) ) ] = require_once( realpath($file) );
}

if( ! function_exists('loadFiles') ){
    function loadFiles($file){
        if( is_array($file) ){
            foreach( $file as $f ){
                require_once($f);
            }
        } else {    
            require_once($file);
        }
    }
}

?>