<?php
require_once __DIR__.'/../src/Api.php';
$path = str_replace('/api/','',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$parts = explode('/', $path);
$parts[1] = isset($parts[1]) && $paths[1] != '' ?$parts[1]:'index';

$api = __DIR__.'/Modules/'.$parts[0].'/'.$parts[1].'.php';
unset($parts[0], $parts[1]);
Api::inject('parts', $parts);

if( file_exists( $api ) ){
    require_once $api;
} else {
echo json_encode([
        'error' => true
    ]);
}