<?php


return [
    
    "debug"             => true,

    "env"               => "dev",

    "config"            => isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"NULL",

    "url"               => isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"NULL",

    "urlScheme"         =>  isset($_SERVER["REQUEST_SCHEME"])?$_SERVER["REQUEST_SCHEME"]:"NULL",

    "error:report"      => E_ALL,

    "error:display"     => 1,

    "timezone"          => "Europe/London"
];
