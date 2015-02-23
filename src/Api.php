<?php
require_once __dir__.'/lib/Request.php';
require_once __dir__.'/lib/Response.php';


class Api {

	private static $verbAllowed = ['GET', 'POST', 'PUT', 'DELETE'];
	private static $verbFunctions = [], $errorFunc, $request, $response;

	public static function auth($callb){
		static::$request = new Request;
		static::$response = new Response;

		call_user_func_array($callb, [
			static::$request,
			static::$response,
			function(){
				static::run(static::$request->verb);
			}
		]);
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
			if( static::$request->accept !== 'application/json' )
			{
				call_user_func_array(static::$errorFunc, [[
				'status' => 405,
				'message' => 'ClientError',
				'error' => 'acceptTypeError',
				'accept '=> static::$request->accept
			], static::$response]);
			} else {
				call_user_func_array( static::$verbFunctions[$verb], [static::$request,static::$response]);
			}
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
