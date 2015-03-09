<?php
require_once __DIR__.'/../../src/Api.php';

/* Own written REST implementation */

$path = str_replace('/api/','',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$parts = explode('/', $path);

$api = __DIR__.'/Modules/'.$parts[0].'/'.$parts[1].'.php';


unset($parts[0], $parts[1]);

Api::inject('params', array_values($parts));
$public = new stdClass;
$public->name = "global corps";
$public->ceo = 'Steve Carlisle';
$public->employed = 450;
$public->links = ['http://link1.com','http://link2.com','http://link3.com','http://link4.com'];
$public->stablished = 2007;
Api::inject('PublicData', $public);


/* bring in the right module if found */
if( file_exists( $api ) ){
    require_once $api;
} else {
echo json_encode([
        'error' => $parts
    ]);
}