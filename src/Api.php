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
* @link https://github.com/trojanspike/BasicAuthCRUD-api
* @version 0.1.27
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/
require_once __dir__.'/lib/Hooks.php';
require_once __dir__.'/lib/Request.php';
require_once __dir__.'/lib/Response.php';

/**
 * Api class setup the Api:: methods , depends on Request , Response & Hooks
 *
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link https://github.com/trojanspike/BasicAuthCRUD-api
 */

class Api {

	/**
	 * array of allowed REQUEST_METHOD
	 *
	 * @var $verbAllowed
	 */
	private static $verbAllowed = ['GET', 'POST', 'PUT', 'DELETE'];
	/**
	 * array of function to fire when verbs passed through REQUEST_METHOD, i.e PUT -> fire
	 *
	 * @var $verbFunctions
	 */
	private static $verbFunctions = [],
	/**
	 * array of values available as 3rd param in Api::VERB($1,$2, $3)
	 *
	 * @var $injects
	 */
	$injects = [],
	/**
	 * Function to fire when verb error , i.e if OPTIONS
	 *
	 * @var $errorFunc
	 */
	$errorFunc,
	/**
	 * Request class instance
	 *
	 * @var $request
	 */
	$request = false,
	/**
	 * Response class instance
	 *
	 * @var $response
	 */
	$response = false;

	/**
	 * Bool , set debug on or off
	 *
	 * @var $debug
	 */
	public static $debug = false,
	/**
	 * Set the uri tp be passed to Request Class
	 *
	 * @var $uri
	 */
	$uri = false;

	/**
	 * ::auth
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  func    $callb  Callback function with 3 args, Request, Response, Run, See docs
	 *
	 * @return void
	 */
	public static function auth($callb)
	{

		if( static::$request == false )
		{
			static::$request = new Request( (static::$uri)?static::$uri:''); // ($parts, $uri)
		}

		if( static::$response == false )
		{
			static::$response = new Response;
		}

		call_user_func_array($callb, [
			static::$request,
			static::$response,
			function(){
				static::run(static::$request->verb);
			},
			static::$injects
		]);
	}

	/**
	 * Inject values to be available in Api::VERB 3rd arg, see docs
	 * 28/03/15 , 16:30
	 * @param  string    	$as  set key of value
	 * @param  any  		$inj Inject value
	 *
	 * @return void
	 */
	public static function inject($as, $inj)
	{
		static::$injects[$as] = $inj;
	}

	/**
	 * Set the function to be fire with verb GET
	 * 28/03/15 , 16:30
	 * @param  func    $callb  Function to use
	 *
	 * @return void
	 */
	public static function get( $callb)
	{
		static::$verbFunctions['GET'] = $callb;
	}

	/**
	 * Set the function to be fire with verb POST
	 * 28/03/15 , 16:30
	 * @param  func    $callb  Function to use
	 *
	 * @return void
	 */
	public static function post($callb)
	{
		static::$verbFunctions['POST'] = $callb;
	}

	/**
	 * Set the function to be fire with verb PUT
	 * 28/03/15 , 16:30
	 * @param  func    $callb  Function to use
	 *
	 * @return void
	 */
	public static function put($callb)
	{
		static::$verbFunctions['PUT'] = $callb;
	}

	/**
	 * Set the function to be fire with verb DELETE
	 * 28/03/15 , 16:30
	 * @param  func    $callb  Function to use
	 *
	 * @return void
	 */
	public static function delete($callb)
	{
		static::$verbFunctions['DELETE'] = $callb;
	}

	/**
	 * Set the function to be fire when an un-allowed verb is sent, i.e OPTIONS
	 * 28/03/15 , 16:30
	 * @param  func    $callb  Function to use
	 *
	 * @return void
	 */
	public static function error($callb)
	{
		static::$errorFunc = $callb;
	}

	/**
	 * Set the Response class to use
	 * 28/03/15 , 16:30
	 * @param Response|ResponseInterface 	$response 	Response class
	 *
	 * @return void
	 */
	public static function setResponse( ResponseInterface $response )
	{
		static::$response = $response;
	}

	/**
	 * Does something interesting
	 * 09/11/15 , 12:48
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function setRequest( RequestInterface $request )
	{
		static::$request = $request;
	}
	/**
	 * access private
	 * Run api called , 3rd arg in Api::auth fn
	 * 28/03/15 , 16:30
	 * @param  string    $verb  	Verb used
	 *
	 * @return void
	 */
	private static function run($verb)
	{
		if( in_array($verb , static::$verbAllowed) && isset(static::$verbFunctions[$verb]) )
		{
			call_user_func_array( static::$verbFunctions[$verb], [static::$request,static::$response, static::$injects]);
		}
		else
		{
			call_user_func_array(static::$errorFunc, [[
				'status' => 405,
				'message' => 'ClientError',
				'error' => 'verbNotAlailable',
				'verb= '=> static::$request->verb
			], static::$response]);
		}
	}

}
