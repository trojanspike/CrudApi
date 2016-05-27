<?php
 /**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * Created by PhpStorm.
 * @copyright  04/11/15 , 09:36 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version
 * @link
 * @since
 */

/* /GET /test-accept -H 'application/javascript,text/html' */
Api::get(function($req, $res, $injects){
 if( $injects['Accept']->text('html') )
 {
  try {
   $res->html(12);
  } catch (Exception $e){
   $res->jsonErr([
     "code" => "html",
     "message" => $e->getMessage()
   ]);
  }
 }
 else
 {
  $res->H301();
 }
});

/* /POST /test-accept -H 'Accept:application/javascript' -D '{"key":"Value"}' */
Api::post(function($req, $res, $injects){
 if( $injects['Accept']->application('javascript') && $data = $req->input(['key']) )
 {
  $res->json(['Accepted', $req->accept, $data]);
 }
 else
 {
  $res->json(['not Accepted', $req->accept]);
 }
});

/* /PUT /test-accept/param1/param2 -u user:password -d '{"key":"value", "key2":"value2"}' -H 'Accept:application/javascript' */
Api::put(function($req, $res, $injects){
 if( $params = $req->params(2) )
 {
   $res->json($params);
 }
 else
 {
  $res->jsonErr([
   "code" => "#th569",
   "message" => "not enough params"
  ]);
 }
});

/* /DELETE /test-accept/id -H 'Accept:application/javascript' */
Api::delete(function($req, $res, $injects){
 if( $injects["Accept"]->application("javascript") && $params = $req->params(1) )
 {
   $res->json([
    "DeleteID" => $params[0]
   ]);
 }
 else
 {
   $res->jsonErr([
    "code" => "Params",
    "message" => "not enough"
   ]);
 }
});