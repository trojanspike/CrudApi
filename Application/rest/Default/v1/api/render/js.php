<?php

use App\Config;
use App\Cache;

Api::get(function($req, $res){

    if( $js = Cache::file()->get('render-js') )
    {
        $res->setContent('application/javascript')->status(200)->outPut($js);
    }
    $content = "";
    $AppJs = glob(path('www').'/app/*.js');
    $AppJs = array_merge($AppJs , glob(path('www').'/app/**/**/*.js'));

    foreach($AppJs as $js)
    {
        $content.=file_get_contents($js);
    }
    Cache::file()->put('render-js', preg_replace("/\/\/.*\n|\/\*.*\*\/\n|\n\n/", "", $content) , 259200);
    $res->setContent('application/javascript')->status(200)->outPut( $content );
});