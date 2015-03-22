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

class Response implements ResponseInterface {
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
