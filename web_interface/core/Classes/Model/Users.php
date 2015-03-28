<?php namespace Model;

use Database\PdoConnect;
use Database\RedisDB;
use PDO;
use App\Session;
use App\Config;

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

class Users extends PdoConnect {
   
    private $redis;

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function __construct(){
        $this->redis = new RedisDB;
        parent::__construct();
    }

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function login($form){
        $query = $this->prepare('SELECT * FROM users WHERE username=:username AND password=:password LIMIT 1');
        $query->bindParam(':username', $form['username']);
        $query->bindParam(':password', $form['password']);
        $query->execute();
        
        if( $row = $query->fetch(PDO::FETCH_ASSOC) ){
            $this->redis->set(Session::get('new_token'), json_encode($row) );
            $this->redis->expire(Session::get('new_token'), Config::get('database.redis')['expires'] );
            return true;
        } else {
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
    public function create($form)
    {
        $query = $this->prepare('INSERT INTO users (id,email,username,password,extra,created_at,updated_at)
        VALUES (null,:email,:uname,:pass,:extra,NOW(),NOW())');
        $query->bindParam(':email', $form['email'] );
        $query->bindParam(':uname', $form['username'] );
        $query->bindParam(':pass', $form['password']);
        $query->bindParam(':extra', $form['extra']);
        return $query->execute();
    }
    
}

?>
