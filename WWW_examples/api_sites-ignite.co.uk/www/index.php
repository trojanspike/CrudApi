<?php
require_once __DIR__.'/../../../src/Api.php';
require_once __DIR__.'/../../../src/Rest.php';

$path = preg_replace('/^\//', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

/* /show page  */
if( $path == '' ){
    header('Location:/docs');
}

/* How strict to make the REQUEST_URI */
if( preg_match("/^([\/a-z0-9]+)$/", $path) && preg_match("/^docs$/", $path) == false ){
    Rest::$Dir = __DIR__.'/../rest/';
    Rest::$debug = true;
    Rest::init(explode('/', $path));
}

?>
<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body ng-app="rest-example" ng-controller="Main">
        <h3>{{ data.name }}</h3>
    </body>
    
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</html>