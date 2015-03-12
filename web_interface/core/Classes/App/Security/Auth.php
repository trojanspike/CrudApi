<?php namespace Model;

use Database\RedisDB;
use App\Session;

class AuthModel extends RedisDB {

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

    public function destroy()
    {
        return $this->del(Session::get('new_token'));
    }

}

?>