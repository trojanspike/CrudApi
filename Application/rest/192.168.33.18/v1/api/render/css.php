<?php
/* http://leafo.net/scssphp/docs/#compiling */
use App\Cache;
use App\Session;

/**
 * Does something interesting
 * 05/11/15 , 14:48
 * @param  string    $where  Where something interesting takes place
 * @param  integer  $repeat How many times something interesting should happen
 * @throws Exception If something interesting cannot happen
 * @return Status
 */
Api::get(function($req, $res, $injects){
    $csrf = $req->get("csrf");
    if($csrf == false || $csrf != Session::get("_CSRF"))
    {
        $res->unAuth();
    }
    if( $css = Cache::file()->get("render-css") )
    {
        $res->css($css);
    }
    else
    {
        $content = "";
        $scss = new scssc();
        $scss->setFormatter("scss_formatter_compressed");
        foreach( glob( path("www")."/app/scss/*.scss" ) as $scssFile )
        {
            if( ! preg_match("/_.*.scss$/", $scssFile) ) {
                $content .= file_get_contents($scssFile);
            }
        }
        $css = $scss->compile($content);
        Cache::file()->put( "render-css" , $css."\n/* Css Comppiles ".date(DATE_RFC2822)." */", 3);
        $res->css($content);
    }
});
