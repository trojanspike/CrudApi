<?php

session_start();

require_once __DIR__.'/../../../src/Api.php';
require_once __DIR__.'/../../../src/Rest.php';

$path = preg_replace('/^\//', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

/* /show page  */
if( $path == '' ){
    header('Location:/home');
}

if( ! isset($_SESSION['_CSRF']) ){
    $_SESSION['_CSRF'] = hash('ripemd128', uniqid());
}


/* uri - /v1/* */
$version = substr($path,0,2);
$path = preg_replace('/^v[0-9]\//', '', $path);
Api::inject('API_V', $version);


/* How strict to make the REQUEST_URI */
if( preg_match("/^([\/\.a-zA-Z0-9]+)$/", $path) && preg_match("/^v[0-9]$/", $version) ){
    Api::inject('uri', $path);
    Rest::$Dir = __DIR__."/../rest/{$version}/";
    Rest::$debug = true;
    Api::$debug = true;
    Rest::init(explode('/', $path));
}

?>

<!DOCTYPE html>
<html>
    <head>
        <base href="/" target="_blank">
    </head>
    <body data-csrf="<?php echo $_SESSION['_CSRF']; ?>">
        
        <h4> Starter one page API backend </h4>
        
        <p> basicAuth </p>
        <p> headerAuth </p>
        <p> postAuth </p>
        <p> auth Token </p>
        
        <p> <a href="/v1/exampleNoAuth" target="_BLANK"> See Example with noAuth </a> </p>
        <p> <a href="/v1/exampleAuth" target="_BLANK"> See Example with Auth </a> </p>
        
        <p> <a href="/v1/none" target="_BLANK"> See Example with debug  </a> </p>
        
        <h4> Use either .htaccess or apache directive to auto point to /index.php </h4>
        <p> Apache example </p>
        <pre>
            
            &lt;VirtualHost *:80&gt;
            	DocumentRoot /var/www/BasicAuthCRUD-api/WWW_examples/rest-start_domain.com/www
            	
            	&lt;Directory "/var/www/BasicAuthCRUD-api/WWW_examples/rest-start_domain.com/www"&gt;
            	    # AllowOverride All
            	    FallbackResource /index.php
            	&lt;/Directory&gt;
            	
            &lt;/VirtualHost&gt;
            
        </pre>
        
    </body>
    
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="/app/js/script.js"></script>
    
</html>