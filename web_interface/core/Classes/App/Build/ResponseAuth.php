<?php namespace App\Build;

use App\Session;

class ResponseAuth {

    private static $obj = [];
    public static $status = 200;

    public static function add(array $data)
    {
        static::$obj = array_merge( static::$obj , $data );
    }

    public static function run($res, array $data = [])
    {
        static::$obj = array_merge( static::$obj , $data );
        static::$obj = array_merge( static::$obj , [
            'authToken' => Session::get('new_token')
        ] );

        $res->status(static::$status)->json(static::$obj);
    }

}