<?php
/* core/classes/Conn */
use Conn\Database;

Database::sqlite(realpath( '../../crud_api.uk.to/API.sqlite' ));



/* Generate a new token */
$new_token = hash('haval224,3', md5(uniqid()).time());
Api::inject('NEW_TOKEN', $new_token);

?>
