<?php namespace Model;

use Database\PdoConnect;
use PDO;

class Users {
    private $dbh;
    
    public function __construct(){
        PdoConnect::sqlite();
        $this->dbh = PdoConnect::getHandler();
    }
  
    public function login($form, $res, $token){
        if( $this->_createValidate($form) ){
            $user = $form['username'];
            $pass = $form['password'];
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
    
    
    public function create($form, $tokenID, $res){
        $result = [];
        $db = $this->dbh;
        
        if( $this->_createValidate($form) ){
            $uid = md5(uniqid());
            
            $create = $db->prepare('INSERT INTO users 
                (user_id, username, extra, password)
                VALUES (:user_id,:username,:extra,:password)');
                
            $create->bindParam(':user_id', $uid);
            $create->bindParam(':username', $form['username']);
            $create->bindParam(':password', md5($form['password']));
            $create->bindParam(':extra', $form['extra']);
            
            
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
        return ( strlen($form['username']) > 4 && strlen($form['password']) > 4 )?true:false;
    }
    
    public function test(){
        return $this->dbh->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>
