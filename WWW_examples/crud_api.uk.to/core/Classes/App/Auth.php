<?php namespace App;

use Database\PdoConnect;
use PDO;

class Auth {
    
    private $dbh;
    
    public function __construct(){
        PdoConnect::sqlite();
        $this->dbh = PdoConnect::getHandler();
    }
    
    public function byToken($oldToken, $newToken){
        $updateToken = $this->dbh->prepare('UPDATE token_sessions SET token=:tokenNew WHERE token=:tokenOld');
        $updateToken->bindParam(':tokenOld', $oldToken);
        $updateToken->bindParam(':tokenNew', $newToken);
        $updateToken->execute();
        return $updateToken->rowCount();
    }
}

?>