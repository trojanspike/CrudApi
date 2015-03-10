<?php
use App\Config;

if( ! function_exists('www_path') ){
    function www_path(){
        return Config::get('site.www');
    }
}

if( ! function_exists('schema_path') ){
    function schema_path(){
        return Config::get('site.Schema');
    }
}

if( ! function_exists('storage_path') ){
    function storage_path(){
        return Config::get('site.storage');
    }
}


?>