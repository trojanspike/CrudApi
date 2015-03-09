window.angular.module('api')
.config(['$urlRouterProvider', '$locationProvider', function($urlRouterProvider, $locationProvider){
    $locationProvider.html5Mode({
      enabled: true,
      requireBase: true
    });
    $urlRouterProvider.otherwise('/docs/v1');
    
}]);