<?php
use App\Config;

foreach (glob(__DIR__."/Config/*.php") as $file) {
    /* Lets not clash with any other possible globals */
    $GLOBALS[ Config::GetId() .'_'. strtoupper(  pathinfo($file , PATHINFO_FILENAME) ) ] = require_once( realpath($file) );
}

if( Config::get('site.production') ){
	foreach (glob(__DIR__."/Config/production/*.php") as $file) {
		 $GLOBALS[ Config::GetId() .'_'. strtoupper(  pathinfo($file , PATHINFO_FILENAME) ) ] = require_once( realpath($file) );
	}
}

foreach (glob(__DIR__."/Helpers/*.php") as $Helpers) {
    require_once( $Helpers );
}

?>
