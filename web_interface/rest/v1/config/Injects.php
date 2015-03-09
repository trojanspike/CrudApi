<?php


/* Generate a new token */
$new_token = hash('haval224,3', md5(uniqid()).time());
Api::inject('NEW_TOKEN', $new_token);

?>
