### basic Auth one page CRUD api
#### no composer - just require
versatile usage , some small examples below
```php
<?php
// api.php
require_once __DIR__.'/src/Api.php';
Api::post(function($request , $response){
	$response->json([
		'access'=>'true'
	]);
});
Api::auth(function($request , $response, $run){
	// would be DB query in real application
	if( $request->basicAuth('username') == 'user' && $request->basicAuth('password') == 'pass' ){
		// success , run Api::post for incoming /POST requests
		$run();
	} else {
		// error , show error message
		$request->status(401)->json([
			'access'=>'false'
		]);
	}
});
```

1. Api {static class}
```php
	Api::HTTP_VERB{ get, post, put, delete }
	Api::auth($1) // $1 = function($1, $2, $3) : $1 = Request class , $2 = Response class , $3 = run Api::HTTP_VERBS
```

2. Request {object class}
```php
	$request->verb // hold HTTP_VERB { GET , POST, PUT, DELETE }
	$request->basicAuth($1) // $1 { string#username / password | empty } returns value or array if empty $_AUTH_ARRAY
	$request->header($1) // $1 { string | empty } returns value if found else false # or array if empty $_HEADERS
	$request->input($1) // $1 { string | empty } returns value if found else false # or array if empty $_POST / $_PUT etc
	$request->get($1) // $1 { string | empty } returns value if found else false # or array if empty $_GET array
	/*
		Origin *
		Allow-headers : Authorization, Content-Type, Accept
		extra Allow-headers : Auth-Token , X-verb, X-username, X-password
	*/
```
3. Response {object class}
```php
	$rsponse->status($1)  // $1 { int } set HTTP status code. return $this
	$rsponse->json($1)  // $1 { array | object } out json encoded, headers set to application/json
	$response->badRequest() // sets status 400 , output jsonObject {message:'ClientError'}
	$response->notFound() // sets status 404 , output jsonObject {message:'ClientError'}
	$response->ok() // sets status 200 , output jsonObject {message:'Success'}
	$response->created() // sets status 201 , output jsonObject {message:'Success'}
```
