<?php namespace App\Security;

use Database\RedisDB;
use App\Session;

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

class Auth extends RedisDB {

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
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
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function destroy()
    {
        return $this->del(Session::get('new_token'));
    }

}

?>