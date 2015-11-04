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

Api::get(function($req, $res, $injects){
 if( $injects['Accept']->text('html') )
 {
   $res->json(['Accepted', $req->accept]);
 }
 else
 {
  $res->json(['not Accepted', $req->accept]);
 }
});

Api::post(function($req, $res, $injects){
 if( $injects['Accept']->application('javascript') )
 {
  $res->json(['Accepted', $req->accept]);
 }
 else
 {
  $res->json(['not Accepted', $req->accept]);
 }
});