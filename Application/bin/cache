#!/usr/bin/env php

<?php
$fnRun = $argv[1];

require_once __DIR__.'/../vendor/autoload.php';
use Database\RedisDB;
$RedisDB = RedisDB::instance();

switch($fnRun)
{

    case "clear":
        $RedisDB->flushDB();
        foreach( glob( path('storage').'/Cache/*' ) as $file )
        {
            unlink($file);
        }
    break;

}

?>