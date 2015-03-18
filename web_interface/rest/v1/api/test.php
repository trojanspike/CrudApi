<?php

use Model\Users;
use App\Session;
use App\Config;
use App\Build\ResponseAuth as Response;
$res = new Response;

Config::set('path.cache', path('storage').'/Cache');
use Database\PdoConnect;
use Database\RedisDB;
$red = RedisDB::instance();

use App\Cache;
Api::get(function($req) use($res, $red) {

    $p1 = $req->params(2);

    switch( $p1[0] ){
        case "redis":
            // echo session_id(); exit();
            // $res->json( $_REQUEST );
            // 5163cc98d9b34cffe268e268a8656cee
            // $red->set( md5(path('storage').'/Cache/test.txt'), 'info'.PHP_EOL.'put'.PHP_EOL.'in' );
            //$red->expire( md5(path('storage').'/Cache/test.txt'), 15);
            // file_put_contents( path('storage').'/Cache/test.txt', 'info'.PHP_EOL.'put'.PHP_EOL.'in' );

            // $Rediss->put('key', 'Content', 25);
            // $res->setContent('text/plain')->outPut( file_get_contents( path('cache').'/test.txt' ) );
            // $res->setContent('text/plain')->outPut( $red->get( $p1[1] ) );
            // $res->setContent('text/plain')->outPut( $Rediss->get($p1[1]) );
            $res->setContent('text/plain')->outPut( `cat /etc/redis/redis.conf` );
            $res->json( Cache::db()->info()  );
            if( Cache::file()->get($p1[1]) ){
                $res->setContent('text/plain')->outPut( Cache::file()->get($p1[1]) );
            }

            $res->json( $red->keys('*') );
        break;
        case "code":
            $res->outPut( $red->get($p1[1]) );
            break;
    }

    $db = new PdoConnect();
    $r = $db->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);

    $res->json( $r );
});


?>
