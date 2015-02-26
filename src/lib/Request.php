<?php

class Request {

	private $_headers, $_basicAuth, $_input;
	public $verb, $accept;

	public function __construct(){
		/* Cors */
		if( isset($_SERVER['HTTP_ORIGIN']) ){
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	        header("Access-Control-Allow-Credentials: true");
	        header("Access-Control-Max-Age: 86400");
		}
		header('Access-Control-Allow-Headers: Authorization, Content-Type, Accept, Auth-Token , X-verb, X-username, X-password');
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		if( function_exists('getallheaders') ){
			$this->_headers = getallheaders();
		} else {
		    $headers = ''; 
		    foreach ($_SERVER as $name => $value) 
		    { 
		        if (substr($name, 0, 5) == 'HTTP_') 
		        { 
		        	/* TODO , ensure Allow-Headers are correct format - X-* Auth-T* */
		            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
		        } 
		    } 
		    $this->_headers = $headers;
		}
		
		$this->_input = json_decode( file_get_contents('php://input'), true );
		$this->verb = isset($this->_headers['X-verb'])?$this->_headers['X-verb']:$_SERVER['REQUEST_METHOD'];
		if( isset( $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) ){
			$this->_basicAuth = [
				'username' => $_SERVER['PHP_AUTH_USER'],
				'password' => $_SERVER['PHP_AUTH_PW']
			];
		} else {
			$this->_basicAuth = false;
		}
		$this->accept = $_SERVER['HTTP_ACCEPT'];
	}


	public function basicAuth($key=false){
		return $this->_returnKeyVals($this->_basicAuth, $key);
	}


	public function get($key=false){
		return $this->_returnKeyVals($_GET, $key);
	}
	public function input($key=false){
		return $this->_returnKeyVals($this->_input, $key);
	}
	
	public function header($key=false){
		return $this->_returnKeyVals($this->_headers, $key);
	}
	
	private function _returnKeyVals($obj, $key){
		if( is_array($key) ){
			return $this->_returnKeyValsFromArray($obj, $key);
		}
		if($key){
			/*#BUG : Some server PHP's casting headers[keys] to lower case , test before returning */
			$keyStr = (isset($obj[$key]))?$key:strtolower($key);
			return ( isset($obj[$keyStr]) )?$obj[$keyStr]:false;
		} else {
			return $obj;
		}
	}
	
	private function _returnKeyValsFromArray($obj , $keyArr){
		$return = [];
		foreach( $keyArr as $key ){
			$_val = $this->_returnKeyVals($obj ,$key);
			if($_val == false){
				return false;
			}
			$return[]=$_val;
		}
		return $return;
	}
	

}

?>
