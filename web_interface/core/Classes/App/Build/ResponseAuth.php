<?php namespace App\Build;

use App\Session;
use Response;
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license
 * @version
 * @link
 * @since
 */
class ResponseAuth extends Response {


    public function json($obj){
        $obj = array_merge( $obj , ['authToken' => Session::get('new_token')] );
        parent::json( $obj );
    }

}