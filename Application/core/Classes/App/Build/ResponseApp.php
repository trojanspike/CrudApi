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
class ResponseApp extends Response {

    private $isAuth;

    /**
     * Does something interesting
     * 24/04/15 , 13:44
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function __construct( $auth = false )
    {
        $this->isAuth = (boolean)$auth;
    }

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  array    $obj  Output as JSON string using Response->json
     * @return void
     */
    public function json( array $obj)
    {
        if( $this->isAuth )
        {
            $obj = array_merge( $obj , ['authToken' => Session::get('new_token')] );
        }
        parent::json( $obj );
    }

    /**
     * Does something interesting
     * 05/11/15 , 14:51
     * @param  string    $content  Css styles
     * @return Status
     */
    public function css( $content )
    {
        $this->setContent("text/css")->status(200)->outPut($content);
    }
    /**
     * Does something interesting
     * 24/04/15 , 13:48
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function html( $content="" )
    {
        if( ! is_string($content) )
        {
            throw new \Exception("Response::html($1) , $1 must be string");
        }
        parent::setContent('text/html')->status(200)->outPut($content);
    }

    /**
     * Does something interesting
     * 20/06/15 , 21:49
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function jpg( $content )
    {
        $this->setContent('image/jpg')->status(200)->outPut( $content );
    }

    /**
     * Does something interesting
     * 04/11/15 , 11:42
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function H301()
    {
        $this->setContent('text/plain')->status(301)->outPut("301 Moved Permanently");
    }

    /**
     * Does something interesting
     * 04/11/15 , 11:50
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function jsonErr( array $obj)
    {
        $this->json([
            "error" => true,
            "code" => $obj["code"],
            "message" => $obj["message"]
        ]);
    }

}