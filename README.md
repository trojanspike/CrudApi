#### Basic Auth CRUD api
##### no composer - just require
- Version 0.1.0
- Flexable usage , some small examples below & example folder
```php
<?php
// api.php
require_once __DIR__.'/src/Api.php';
require_once __DIR__.'/path/to/Database.php';
Api::inject('DB', Database::init()); // for e.g
Api::post(function($request , $response, $injects){
	$response->json([
		'access'=>'true',
		'userInfo' => $inject['userInfo']
	]);
});
Api::auth(function($request , $response, $run, $injects){
	$db = $injects['DB'];
	$Auth = $request->basicAuth();
	if(!$Auth){
		$response->status(401)->json([
			'access'=>'false'
		]);
		exit();
	}
	// PDO $db->prepare would most likely be used , here just quick/rough example
	if( $db->query('SELECT FROM users WHERE user='.$Auth["username"].' AND pass='.$Auth["password"]) ){
		// success , run Api::post for incoming /POST requests
		Api::inject('userInfo', $db->fetchAll());
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
* ::inject($1, $2) = $1{string}, $2{*any , onject , function , class etc} # injects last into ::auth , ::VERB, get, put etc
* ::auth($1) # $1 = function($1, $2, $3) : $1 = Request class , $2 = Response class , $3 = run
* Example might be :
```php
	Api::inject('run', true);
	Api::post(function($req, $res, $injects){
		$res->json( $req->input() );
	});
	Api::error(function($mess, $res){
		$res->status($mess['status'])json( $mess );
	});
	Api::auth(function($req, $res, $run, $injects){
		if($injects['run']){
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
- Allow-Origin: *
- Allow-Headers : Authorization, Content-Type, Accept, X-username , X-password , X-verb , Auth-Token

```bash
	curl http://domain.com/api?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json' # open api
	curl -u user:pass http://domain.com/auth?module=users -X POST -d '{"key":"val"}' -H 'accept:application/json' # basicAuth api
	curl http://domain.com/headerAuth?module=users -X POST -d '{"key":"val"}' -H 'X-username:user' -H 'X-password:pass' -H 'accept:application/json' # header auth
	## using injects
	curl -u user:pass http://domain.com/auth?module=injects -X POST -d '{"key":"val"}' -H 'accept:application/json' # basicAuth /api/inject
	curl -u user:pass http://domain.com/auth?module=injects -X PUT -d '{"job":"Security"}' -H 'accept:application/json' # basicAuth /api/inject
	### Auth using Auth-Token
	curl http://domain.com/token/ -X GET -H 'Auth-Token:tk-1fg5@e45s' -H 'accept:application/json'
	curl http://domain.com/token/ -X PUT -H 'Auth-Token:tk-1fg5@e45s' -H 'accept:application/json'
```

```bash
 ## Rest api
 # open to web access - no header accept needed
 curl https://basicauthcrud-api-trojanspike.c9.io/api/web/open/15/tester/value
 # closed to web , header accept is needed
 curl https://basicauthcrud-api-trojanspike.c9.io/api/web/closed/15/tester/value -H 'accept:application/json'
 
 # auth require , Token / HeaderAuth / BasicAuth
 curl https://basicauthcrud-api-trojanspike.c9.io/api/users/tokenAuth/15/tester/value -H 'Auth-Token:abc123' -H 'accept:application/json'
 curl https://basicauthcrud-api-trojanspike.c9.io/api/users/headerAuth/15/tester/value -H 'x-username:user123' -H 'x-password:pass123' -H 'accept:application/json'
 curl -u user123:pass123 https://basicauthcrud-api-trojanspike.c9.io/api/users/basicAuth/15/tester/value -H 'accept:application/json'
```


TODO
* ~~add headers X-* when func "getallheaders" isn't avail~~
* Request #get,input,header to accept array and returns all if avail else false. ->get(['id','key','page'])
* ~~add Api::inject method to add onto Api::VERB - callback i.e Api::inject([DB, $Data_arrays])~~
