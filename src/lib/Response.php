<?php

class Response {
	private $_status, $_content = false;

	public function __construct(){
		$this->_status = 200;
	}
	
	
	/* Setting methods */
	
	public function setContent($content){
		$this->_content = $content;
		return $this;
	}
	
	public function setHeader($header){
		if( is_array($header) ){
			foreach( $header as $head ){
				header($head);
			}
		} else {
			header($header);
		}
		return $this;
	}

	public function status($code){
		$this->_status = (int)$code;
		return $this;
	}
	
	
	/* output methods */
	
	public function json($obj){
		$this->setHeader('Content-Type:application/javascript');
		$this->outPut(json_encode($obj));
	}
	
	public function outPut($content){
		http_response_code($this->_status);
		if( $this->_content !== false ){
			header('Content-Type:'.$this->_content);
		}
		echo $content;
		header('Content-Length:'.strlen($content));
		header('Connection:close');
		exit();
	}
	
	
	/* Quick herlper methods */

	public function badRequest(){
		$this->status(400)->json([
			'message' => 'ClientError'
		]);
	}
	
	public function unAuth(){
		$this->status(401)->json([
			'message' => 'ClientError'
		]);
	}

	public function notFound(){
		$this->status(404)->json([
			'message' => 'ClientError'
		]);
	}

	public function ok(){
		$this->json([
			'message' => 'Success'
		]);
	}

	public function created(){
		$this->status(201)->json([
			'message' => 'Success'
		]);
	}
	
	/* Private Methods */

}

?>
