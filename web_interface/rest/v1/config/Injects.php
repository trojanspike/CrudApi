<?php

use App\Session;
/* Generate a new token */
$new_token = hash('haval224,3', md5(uniqid()).time());
Session::set('new_token', $new_token);
Session::set('data', ['ok']);
?>
