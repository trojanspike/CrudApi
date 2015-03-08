<?php

/** Api github.com/trojanspike/BasicAuthCRUD-api
*
* Copyright (c) 2015 Lee Mc Kay (http://www.@site/)
*
* Licensed under The MIT License
* 
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*
* @copyright Copyright 2015 (c) Lee Mc Kay (http://www.@site/)
* @link http://www.@site/
* @version 0.1.27
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

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
			$this->_ensureHeaderWord();
		} else {
		    $headers = ''; 
		    foreach ($_SERVER as $name => $value) 
		    { 
		        if (substr($name, 0, 5) == 'HTTP_') 
		        { 
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
			return ( isset($obj[$key]) )?$obj[$key]:false;
		} else {
			return $obj;
		}
	}
	
	private function _returnKeyValsFromArray($obj , $keyArr){
		$dataArr = [];
		foreach( $keyArr as $key ){
			$_val = $this->_returnKeyVals($obj ,$key);
			if($_val == false){
				return false;
			}
			$dataArr[$key]=$_val;
		}
		return $dataArr;
	}
	
	
	private function _ensureHeaderWord(){
		foreach( $this->_headers as $HKey => $HVal ){
			array_shift($this->_headers);
			$this->_headers[ucwords($HKey)]=$HVal;
		}
	}
	

}

?>
