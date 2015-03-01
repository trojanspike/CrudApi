<?php

class Response {
	private $_status, $_content;

	public function __construct(){
		$this->_status = 200;
		$this->_content = 'application/javascript';
	}
	
	
	/* Setting methods */
	
	public function contentType($content){
		$this->_content = $content;
		return $this;
	}

	public function status($code){
		$this->_status = (int)$code;
		return $this;
	}
	
	
	/* output methods */
	
	public function json($obj){
		/* default is 200 & application/javascript */
		$this->render(json_encode($obj));
	}
	
	public function outPut($content){
		http_response_code($this->_status);
		header('Content-Type: '.$this->_content);
		echo $content;
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
	
	
	
	/* @start private */
	private function render($content){
		/* 5.4* */
		http_response_code($this->_status);
		header('Content-Type: '.$this->_content);
		echo $content;
		exit();
	}

}

?>
