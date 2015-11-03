<?php namespace Model;

use Database\PdoConnect;
use Database\RedisDB;
use PDO;
use App\Session;
use App\Config;

/**
 * Database interaction for Users table
 *
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Users extends PdoConnect {

    private $redis;

    /**
     * Set Redis DB Var to be used in User class
     * 28/03/15 , 16:30
     *
     * @return void
     */
    public function __construct()
    {
        $this->redis = new RedisDB;
        parent::__construct();
    }

    /**
     * Check user credentials for logging in
     * 28/03/15 , 16:30
     * @param  array    $form  ['username'] & ['password'] required
     *
     * @return bool, false = user not found & true = user found , redis session set with auth token
     */
    public function login( array $form)
    {
        $query = $this->prepare('SELECT * FROM users WHERE username=:username AND password=:password LIMIT 1');
        $query->bindParam(':username', $form['username']);
        $query->bindParam(':password', $form['password']);
        $query->execute();

        if( $row = $query->fetch(PDO::FETCH_ASSOC) )
        {
            $this->redis->set(Session::get('new_token'), json_encode($row) );
            $this->redis->expire(Session::get('new_token'), Config::get('database.redis')['expires'] );
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
     * @param  array    $form  ['email']['username']['password']['extra'], create new user
     *
     * @return bool , executed query
     */
    public function create( array $form)
    {
        $activationKey = md5(uniqid(rand(), true));
        $query = $this->prepare('INSERT INTO users (id,email,username,password,extra,actived,activationKey,created_at,updated_at)
        VALUES (null,:email,:uname,:pass,:extra,false,:activationKey,NOW(),NOW())');
        $query->bindParam(':email', $form['email'] );
        $query->bindParam(':uname', $form['username'] );
        $query->bindParam(':pass', $form['password']);
        $query->bindParam(':extra', $form['extra']);
        $query->bindParam(':activationKey', $activationKey);
        return $query->execute(); /* TODO -
            if success , send welcome email & activation key
            GET /activate/someKey?email=email@email.com
         */
    }

}

?>
