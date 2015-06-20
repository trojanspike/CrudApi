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

/* Add a local Config file , ignored bu git. to be used for local-dev env */
if( file_exists( __DIR__.'/../local_config.php' ) ){
    $localConf = require( __DIR__.'/../local_config.php' );
    foreach( $localConf as $confKey => $confArray )
    {
        $GLOBALS[Config::GetId() .'_'.strtoupper( $confKey )] = array_merge( Config::get($confKey) , $confArray );
    }
}
?>
