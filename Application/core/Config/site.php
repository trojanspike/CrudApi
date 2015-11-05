<?php


return [
    
    "debug"             => true,

    "env"               => "prod",

    "config"            => $_SERVER['HTTP_HOST'],

    "url"               => $_SERVER['HTTP_HOST'],

    "urlScheme"         =>  $_SERVER["REQUEST_SCHEME"],

    "error:report"      => E_ALL,

    "error:display"     => 1,

    "timezone"          => "Europe/London"
];
