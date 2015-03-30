<?php namespace App\Build;

use App\Session;
use Response;
/**
 * Extends Response class for custom methods & injected output
 *
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */
class ResponseAuth extends Response {


    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  array    $obj  Output as JSON string using Response->json
     * @return void
     */
    public function json( array $obj)
    {
        $obj = array_merge( $obj , ['authToken' => Session::get('new_token')] );
        parent::json( $obj );
    }

}