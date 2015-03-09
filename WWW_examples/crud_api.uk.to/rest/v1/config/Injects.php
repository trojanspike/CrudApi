<?php

/* have a use App\Security
    Security::level(2),or something
*/
header('Set-Cookie:false');
header('X-Powered-By:');


/* Generate a new token */
$new_token = hash('haval224,3', md5(uniqid()).time());
Api::inject('NEW_TOKEN', $new_token);

?>
