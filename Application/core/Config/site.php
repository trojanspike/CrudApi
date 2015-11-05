<?php


return [
    
    "debug"             => true,

    "env"               => "prod",

    "config"            => isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"NULL",

    "url"               => isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"NULL",

    "urlScheme"         =>  $_SERVER["REQUEST_SCHEME"],

    "error:report"      => E_ALL,

    "error:display"     => 1,

    "timezone"          => "Europe/London"
];
