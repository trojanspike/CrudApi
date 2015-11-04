<?php namespace App\Security;

use Database\RedisDB;
use App\Session;

/**
 * Check user Auth creds
 *
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Auth extends RedisDB {

    /**
     * Checks token passes is in redis DB and sets Session:userInfo if found & renames that key to next auth token
     * 28/03/15 , 16:30
     * @param  string    $token  token passed thought the header or post
     * @return bool, true = user found | false = user not found
     */
    public function byToken($token){
        if( $info = $this->get($token) )
        {
            Session::set('userInfo', $info );
            $this->rename( $token , Session::get('new_token') );
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Deletes the user auth from Redis DB - ending the Auth session
     * 28/03/15 , 16:30
     *
     * @return Redis->del result , bool
     */
    public function destroy()
    {
        return $this->del(Session::get('new_token'));
    }

}