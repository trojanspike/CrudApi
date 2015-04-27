<?php
session_start();

require_once __DIR__.'/../vendor/autoload.php'; /* Composer */

/**
 * TODO :
App start class passing $_SERVER URI
Cleans up index.php & makes phpunit tests easier


use App\Start;
Start::app($_SERVER['REQUEST_URI']);
**/

use App\Config;

ini_set("display_errors", config::get('error.display') );
error_reporting( config::get('error.report') );

date_default_timezone_set('Europe/London');
ini_set('date.timezone', 'Europe/London');


$path = preg_replace('/^\//', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

/* /show page  */
if( $path == '' ){
    header('Location:/docs');
}


$version = substr($path,0,2);
$path = preg_replace('/^v[0-9]\//', '', $path);

/*
use Api;
use Rest;
*/

Api::inject('API_V', $version);

/* How strict to make the REQUEST_URI */
if( preg_match("/^([\/\-\.a-zA-Z0-9]+)$/", $path) && preg_match("/^v[0-9]$/", $version) ){
    Api::$uri = $path; // needed for $req->uri & req->params()
    Api::$debug = Config::get('site.debug');
    Rest::$Dir = __DIR__."/../rest/{$version}/";
    Rest::$debug = Config::get('site.debug');
    
    /* TODO : Poss change ?
    Rest::conf([
        'config' => path/to/policies,
        'apis' => path/to/apiDir
    ]);
    */
    Rest::init(explode('/', $path));
}

use App\View;
use App\Session;
Session::start();

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.1/animate.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">
        <link rel="stylesheet" href="/app/css/style.css" type="text/css" />
        <base href="/" target="_blank">
    </head>
    <body ng-app="api" ng-cloak api-csrf="<?php echo Session::get('_CSRF'); ?>">
        
        <script type="text/ng-template" id="#app/pages/docs/html/abstract.html">
            <section class="col-md-9">
                <h4>@ Section Users abstract #2</h4>
                <p> in prod -> render all views onto page instead of loading </p>
                <p> View::getViews() </p>
                <div class="row">
                    
                    <ui-view name="main"></ui-view>
                    
                </div>
                
            </section>
        </script>
        
        <div class="container clear-float">
            
            <header class="page-header" ng-controller="UserInfoCtl">
                <h2 style="text-align:center;"> "{{ quote.message }}" </h2>
                
                <div class="jumbotron">
                    
                    <h4 style="text-align:center;" class="alert alert-warning" ng-hide="message === true"> {{ message }} </h4>
                  
                  <p>
                          <a class="btn btn-dark btn-lg btn-block" ui-sref="docs.session" ui-sref-active="active" role="button"> Session Info > Learn more</a>
                    </p>
                    
                    <pre>  <code> 
                        {{ data.Session }}
                        
                    </code>  </pre>
                      
                      
                      <div class="row">
                        <div class="col-sm-6">
                            <p> <a ng-click="fn.noAuth()" class="btn btn-dark btn-lg btn-block" role="button"> Make a call to no Auth API </a> </p>
                        </div>
                        <div class="col-sm-6">
                            <p> <a ng-click="fn.Auth()" class="btn btn-dark btn-lg btn-block" role="button"> Make a call to Auth API </a> </p>
                        </div>
                    </div>
                    <pre>  <code>  {{ quote }} </code>  </pre>
                    <p ng-show="data.userInfo.loggedin === true" ><a ng-click="fn.logout()" class="btn btn-dark btn-lg btn-block" role="button"> Log out </a></p>
                </div>
                
            </header>
            
            <div class="content">
                
                
                <aside class="col-md-3">
                    
                    
                    <div class="list-group">
                        
                        
                      <a ui-sref="docs.v1" class="list-group-item" ui-sref-active="active">
                        <h4 class="list-group-item-heading">docs.v1 <i class="glyphicon glyphicon-chevron-right pull-right"></i> </h4>
                      </a>
                      
                      <a ui-sref="user.create" class="list-group-item" ui-sref-active="active">
                        <h4 class="list-group-item-heading">user.create <i class="glyphicon glyphicon-chevron-right pull-right"></i> </h4>
                      </a>
                      
                      <a ui-sref="user.login" class="list-group-item" ui-sref-active="active">
                        <h4 class="list-group-item-heading">Session.create <i class="glyphicon glyphicon-chevron-right pull-right"></i> </h4>
                      </a>
                      
                      
                    </div>
                    
                </aside>
        
        <ui-view class="page"></ui-view>
        
        </div> <!-- /#.content -->
        
    </div> <!-- #.container -->
        
        <footer>
            <div class="container">
                <div class="row">
                    <p class="col-md-4">
                        dui, sed euismod est
                    </p>
                    <p class="col-md-4">
                        dui, sed euismod est
                    </p>
                    <p class="col-md-4">
                        dui, sed euismod est
                    </p>
                </div>
            </div>
        </footer>
    </body>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.13/angular-ui-router.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular-animate.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>

    <?php echo View::getJS( realpath(__DIR__.'/app/') ); ?>
    <?php echo View::getJS( realpath(__DIR__.'/app/pages/') ); ?>
    
</html>
