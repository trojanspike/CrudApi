<?php
use App\Config;

// path('www')

if( ! function_exists('path') ){
    function path($path){
        return Config::get('path.'.$path);
    }
}

if( ! function_exists('www_path') ){
    function www_path(){
        return Config::get('path.www');
    }
}

if( ! function_exists('schema_path') ){
    function schema_path(){
        return Config::get('path.schema');
    }
}

if( ! function_exists('storage_path') ){
    function storage_path(){
        return Config::get('path.storage');
    }
}


?>