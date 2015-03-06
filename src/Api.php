<?php
require_once __dir__.'/lib/Request.php';
require_once __dir__.'/lib/Response.php';


class Api {

	/**
	* @var 
	**/
	private static $verbAllowed = ['GET', 'POST', 'PUT', 'DELETE'];
	private static $verbFunctions = [], $injects = [], $errorFunc, $request, $response;
	public static $debug = false;

	/**
	* ::auth
	*
	* @param function				$callb 
	**/
	public static function auth($callb){
		static::$request = new Request;
		static::$response = new Response;

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
	 * ::inject
	 *
	 * @param string				$as
	 * @param *any					$inj
	 **/
	public static function inject($as, $inj){
		static::$injects[$as] = $inj;
	}

	public static function get($callb){
		static::$verbFunctions['GET'] = $callb;
	}
	public static function post($callb){
		static::$verbFunctions['POST'] = $callb;
	}
	public static function put($callb){
		static::$verbFunctions['PUT'] = $callb;
	}
	public static function delete($callb){
		static::$verbFunctions['DELETE'] = $callb;
	}
	public static function error($callb){
		static::$errorFunc = $callb;
	}



	private static function run($verb){
		if( in_array($verb , static::$verbAllowed) && isset(static::$verbFunctions[$verb]) ){
			call_user_func_array( static::$verbFunctions[$verb], [static::$request,static::$response, static::$injects]);
		} else {
			call_user_func_array(static::$errorFunc, [[
				'status' => 405,
				'message' => 'ClientError',
				'error' => 'verbNotAlailable',
				'verb= '=> static::$request->verb
			], static::$response]);
		}
	}

}


?>
