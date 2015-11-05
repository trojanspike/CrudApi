<?php

use Model\Users;
use App\Session;
use App\Config;

Config::set('path.cache', path('storage'));
use Database\PdoConnect;
use Database\RedisDB;
$red = RedisDB::instance();

use App\Cache;
Api::get(function($req, $res) use($red) {

$DB = new PdoConnect;
if( ! Cache::db()->get("SELECT * FROM users") )
{
	Cache::db()->put("SELECT * FROM users", json_encode( $DB->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC) ) , 25);
}

    if( $params = $req->params(2) )
    {
        switch($params[0])
        {
            case "redis":

            break;
        }
    }
    else
    {

    }

    switch( $p1[0] )
    {
        case "redis":
            // echo session_id(); exit();
            // $res->json( $_REQUEST );
            // 5163cc98d9b34cffe268e268a8656cee
            // $red->set( md5(path('storage').'/Cache/test.txt'), 'info'.PHP_EOL.'put'.PHP_EOL.'in' );
            //$red->expire( md5(path('storage').'/Cache/test.txt'), 15);
            // file_put_contents( path('storage').'/Cache/test.txt', 'info'.PHP_EOL.'put'.PHP_EOL.'in' );


            // $res->setContent('text/plain')->outPut( $red->get( $p1[1] ) );
            // $res->setContent('text/plain')->outPut( $Rediss->get($p1[1]) );
//            $res->setContent('text/plain')->outPut( `cat /etc/redis/redis.conf` );
//            $res->json( Cache::db()->info()  );
            if( Cache::file()->get($p1[1]) )
            {
                $res->setContent('text/plain')->outPut( Cache::file()->get($p1[1]) );
            }

            $res->json( $red->keys('*') );
        break;
        case "code": // CACHE_DB_0d4f1741843d9fef07e4f32c1b079803
            // $res->setContent('application/javascript')->outPut( $red->get($p1[1]) );
            $res->setContent('application/javascript')->outPut( Cache::db()->get( "SELECT * FROM users" ) );
            break;
    }

    $db = new PdoConnect();
    $r = $db->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);

    $res->json( $r );
});
