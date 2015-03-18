<?php namespace App\Build;

use App\Session;
use Response;

class ResponseAuth extends Response {


    public function json($obj){
        $obj = array_merge( $obj , ['authToken' => Session::get('new_token')] );
        parent::json( $obj );
    }

}