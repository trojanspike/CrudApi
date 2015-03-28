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

require_once __dir__.'/lib/Request.php';
require_once __dir__.'/lib/Response.php';

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license
 * @version
 * @link
 * @since
 */

class Api {

	/**
	* @var 
	**/
	private static $verbAllowed = ['GET', 'POST', 'PUT', 'DELETE'];
	private static $verbFunctions = [], $injects = [], $errorFunc, $request, $response;
	public static $debug = false, $uri = false;

	/**
	 * ::auth
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function auth($callb)
	{
		static::$request = new Request( (static::$uri)?static::$uri:''); // ($parts, $uri)

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
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function inject($as, $inj)
	{
		static::$injects[$as] = $inj;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function get($callb)
	{
		static::$verbFunctions['GET'] = $callb;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function post($callb)
	{
		static::$verbFunctions['POST'] = $callb;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function put($callb)
	{
		static::$verbFunctions['PUT'] = $callb;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function delete($callb)
	{
		static::$verbFunctions['DELETE'] = $callb;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function error($callb)
	{
		static::$errorFunc = $callb;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
	 */
	public static function setResponse( ResponseInterface $response )
	{
		static::$response = $response;
	}

	/**
	 * Does something interesting
	 * 28/03/15 , 16:30
	 * @param  string    $where  Where something interesting takes place
	 * @param  integer  $repeat How many times something interesting should happen
	 * @throws Exception If something interesting cannot happen
	 * @return Status
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
