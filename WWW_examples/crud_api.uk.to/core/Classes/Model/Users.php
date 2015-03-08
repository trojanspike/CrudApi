<?php namespace Model;

use Conn\Database;
use PDO;

class Users {
    private $dbh;
    
    public function __construct(){
        $this->dbh = Database::getHandler();
    }
  
// curl -H 'accept:application/json' http://crud-api.uk.to/v1/user/login -X POST -d '{"username":"trojanspike", "password":"password""} 
    public function login($form, $res, $token){
        if( $this->_createValidate($form) ){
            $user = $form[0];
            $pass = $form[1];
            $q = $this->dbh->prepare("SELECT * FROM users WHERE username=:username AND password=:pass LIMIT 1");
            $q->bindParam(':username', $user);
            $q->bindParam(':pass', md5($pass));
            
            if( $q->execute() ){
                if( $result = $q->fetch(PDO::FETCH_ASSOC) ){
                     /* Do a token change - is usually done through Auth.php */
                    if( $this->tokenChange($result['user_id'], $token) ){
                        $res->json( array_merge($result, ['authToken' => $token, 'error' => false]) );
                    } else {
                        $res->json( ['error' => true, 'message' => 'inputError@login#27'] );
                    }
                    
                } else {
                    $res->json( ['error' => true, 'message' => 'inputError@login#31'] );
                }
                // $res->json( $result->user_id );
            } else {
                $res->json( ['error' => true, 'message' => 'inputError@login'] );
            }   
            
        } else {
            $res->json( ['error' => true, 'message' => 'inputError@login'] );
        }
    }
    
// curl -H 'accept:application/json' http://crud-api.uk.to/v1/user/create -X POST -d '{"_csrf":"abc123", "username":"trojanspike", "password":"password", "extra":"someExtra Info"}'    
    public function create($form, $tokenID, $res){
        $result = [];
        $db = $this->dbh;
        
        if( $this->_createValidate($form) ){
            $uid = md5(uniqid());
            
            $create = $db->prepare('INSERT INTO users 
                (user_id, username, extra, password)
                VALUES (:user_id,:username,:extra,:password)');
                
            $create->bindParam(':user_id', $uid);
            $create->bindParam(':username', $form[0]);
            $create->bindParam(':password', md5($form[1]));
            $create->bindParam(':extra', $form[2]);
            
            
            $token = $db->prepare('INSERT INTO token_sessions (user_id,token) VALUES (:u_id, :token)');
            
            $token->bindParam(':token', $tokenID);
            $token->bindParam(':u_id', $uid);
            
            if( $create->execute() && $token->execute() ){
                $res->json( ['error' => false, 'message' => 'userCreated', 'authToken' => $tokenID] );
            } else {
                $res->json( $db->errorInfo() );
            }
            
        } else {
            $res->json( ['error' => true, 'message' => 'inputError'] );
        }
    }
    
    
    /*
    @ return bool
    */
    private function tokenChange($uid, $newToken){
        $query = $this->dbh->prepare('UPDATE token_sessions SET token=:token WHERE user_id=:user_id');
        $query->bindParam(':user_id', $uid);
        $query->bindParam(':token', $newToken);
        return $query->execute();
    }
    
    private function _createValidate($form){
        return ( strlen($form[0]) > 4 && strlen($form[1]) > 4 )?true:false;
    }
    
    public function test(){
        return $this->dbh->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>
