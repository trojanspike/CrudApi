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


    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function json($obj)
    {
        $obj = array_merge( $obj , ['authToken' => Session::get('new_token')] );
        parent::json( $obj );
    }

}