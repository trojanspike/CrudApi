<?php

use App\Config;

Api::post(function($req, $res, $injects){
// curl -F "uploaded_file=@./image.jpg" http://crud-api.uk.to/v1/upload
// curl -F "uploaded_file=@./gimp.xcf" -F "other_file=@./image.jpg" -F "pgn_file=@./image.png" http://crud-api.uk.to/v1/upload
// application/octet-stream

// curl -F "uploaded_file=@./gimp.xcf" -F "other_file=@./image.jpg" -F "pgn_file=@./image.png" http://crud-api.uk.to/v1/upload -i -H 'authToken:abc132'
/******************************************/
    
   foreach( $_FILES as $key => $file ){
       $fileName = $file["name"];
       $fileTmpLoc = $file["tmp_name"];
       $pathAndName = Config::get('site.storage').'/uploads/'.$fileName;
       $moveResult = move_uploaded_file($fileTmpLoc, $pathAndName);
       /** if ($moveResult == true) {
            $res->ok();
        } else {
            $res->ok();
        } **/
   }
/******************************************/
/* "text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,*\/*;q=0.8" */

/*
reg# image\/ #reg
*/
    $res->ok();
});

Api::get(function($req, $res, $injects){
    $html = <<<EOF
    <form action="/v1/upload" method="POST"  enctype="multipart/form-data">
    <input type="file" name="pic" accept="image/jpg">
    <input type="submit" value="send">
    </form>
EOF;
$str = "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
$m = preg_replace( "/.*(image\/[a-z]{0,4}+).*/" , '$1', $str);



    $res->setContent('text/html')->outPut( $html );
    
});

?>