window.angular.module('api')
.config(['$stateProvider', '$locationProvider', '$urlRouterProvider', function($stateProvider, $locationProvider, $urlRouterProvider){
    $stateProvider
        .state('docs', {
            url : '/docs',
            abstract : true,
            templateUrl : 'app/pages/docs/html/abstract.html',
            controller : 'DocsMainctl',
            controllerAs : 'ct',
            data : {}
        })
        .state('docs.v1', {
            url : '/v1',
            views : {
                main : {
                    templateUrl : 'app/pages/docs/html/main.html'
                }
            }
        }).state('docs.session', {
            url : '/session',
            views : {
                main : {
                    templateUrl : 'app/pages/docs/html/session.html'
                }
            }
        });
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: true
        });
        $urlRouterProvider.otherwise('/docs/v1');
}]);