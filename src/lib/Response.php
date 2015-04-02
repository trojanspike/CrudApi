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

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link https://github.com/trojanspike/BasicAuthCRUD-api
 */
interface ResponseInterface {

	public function setContent($content);
	public function setHeader($header);
	public function status($code);
	public function outPut($content);

}

/**
 * simple response class , setting header content, output etc
 *
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link https://github.com/trojanspike/BasicAuthCRUD-api
 */
class Response implements ResponseInterface {
	private $_status = 200, $_content = false;

	/**
	 * Set the page content type, ie. js , xml, etc
	 * 28/03/15 , 16:30
	 * @param  string    $content  Content type
	 *
	 * @return self
	 */
	public function setContent( $content)
	{
		$this->_content = $content;
		return $this;
	}

	/**
	 * set header option
	 * 28/03/15 , 16:30
	 * @param  array|string    $header  Where something interesting takes place
	 *
	 * @return self
	 */
	public function setHeader($header)
	{
		if( is_array($header) )
		{
			foreach( $header as $head )
			{
				header($head);
			}
		}
		else
		{
			header($header);
		}
		return $this;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function status($code)
	{
		$this->_status = (int)$code;
		return $this;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function json($obj)
	{
		$this->setHeader('Content-Type:application/javascript');
		$this->outPut(json_encode($obj));
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function outPut($content)
	{
		http_response_code($this->_status);

		if( $this->_content !== false )
		{
			header('Content-Type:'.$this->_content);
		}
		echo $content;
		header('Content-Length:'.strlen($content));
		header('Connection:close');
		exit();
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function badRequest()
	{
		$this->status(400)->json([
			'message' => 'ClientError'
		]);
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function unAuth()
	{
		$this->status(401)->json([
			'message' => 'ClientError'
		]);
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function notFound()
	{
		$this->status(404)->json([
			'message' => 'ClientError'
		]);
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function ok()
	{
		$this->json([
			'message' => 'Success'
		]);
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public function created()
	{
		$this->status(201)->json([
			'message' => 'Success'
		]);
	}

}
