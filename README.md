#### Basic Auth one page CRUD api
##### no composer - just require
Flexable usage , some small examples below & example folder
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
		$response->status(401)->json([
			'access'=>'false'
		]);
	}
});
```

### Requirements

* PHP 5.4 >

#### Api {static class} methods
* ::HTTP_VERBS{ get, post, put, delete }
* ::error($1) # $1 = function($1, $2) : $1 = error message , $2 = Response class
* ::auth($1) # $1 = function($1, $2, $3) : $1 = Request class , $2 = Response class , $3 = run
* Example might be :
```php
	Api::post(function($req, $res){
		$res->json( $req->input() );
	});
	Api::error(function($mess, $res){
		$res->status($mess['status'])json( $mess );
	});
	Api::auth(function($req, $res, $run){
		if(true){
			$run();
		} else {
			$res->forBidden();
		}
	});
```
#### Request {object class} methods
* ->verb	# current http verb , X-verb over ride this & can be overridden
* ->basicAuth($1) // $1 { string#username / password | empty } returns value or array if empty $_AUTH_ARRAY
* ->header($1) // $1 { string | empty } returns value if found else false # or array if empty $_HEADERS
* ->init($1) // $1 { string | empty } returns value if found else false # or array if empty $_POST / $_PUT etc
* ->get($1) // $1 { string | empty } returns value if found else false # or array if empty $_GET array
* Example might be :
```php
	Api::put(function($request, $response){
		$id = $request->get('post-id'); // $_GET['post-id'];
		$inputs = $request->input(); // like $_POST only PUT
	});
```
#### Response {object class} methods
* ->status($1)  // $1 { int } set HTTP status code. return $this
* ->json($1)  // $1 { array | object } out json encoded, headers set to application/json
* ->badRequest() // sets status 400 , output jsonObject {message:'ClientError'}
* ->notFound() // sets status 404 , output jsonObject {message:'ClientError'}
* ->ok() // sets status 200 , output jsonObject {message:'Success'}
* ->created() // sets status 201 , output jsonObject {message:'Success'}
* Example might be :
```php
	Api::post(function($request, $response){
		$message = $request->input('message');
		DB->insert($message);
		$response->created();
	});
	Api::get(function($request , $response){
		$response->json( DB->getAll(true) );
	});
	Api::error(function($request, $response){
		$response->badRequest();
	});
```
#### Allow - Origin & Header
Allow-Origin: *
Allow-Headers : Authorization, Content-Type, Accept, X-username , X-password , X-verb , Auth-Token

```bash
	curl http://domain.com/api?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json' # open api
	curl -u user:pass http://domain.com/auth?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json' # basicAuth api
	curl http://domain.com/headerAuth?module=users -X POST -d '{"key":"val"}' -H 'X-username:user' -H 'X-password:pass' -H 'accept:application/json' # header auth
```


TODO
* add headers X-* when func "getallheaders" isn't avail
* Request #get,input,header to accept array and returns all if avail else false. ->get(['id','key','page'])
* add Api::inject method to add onto Api::VERB - callback i.e Api::inject([DB, $Data_arrays])
