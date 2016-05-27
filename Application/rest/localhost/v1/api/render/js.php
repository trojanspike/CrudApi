<?php

use App\Config;
use App\Cache;
use App\Session;
use JSMin\JSMin;
Api::get(function($req, $res){
    $csrf = $req->get("csrf");

    if( $csrf == false || $csrf !== Session::get("_CSRF") )
    {
        $res->json(["error"]);
    }

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
    $JS_minifies = JSMin::minify( $content );
    Cache::file()->put('render-js', $JS_minifies , 25);
    $res->setContent('application/javascript')->status(200)->outPut( $JS_minifies );
});