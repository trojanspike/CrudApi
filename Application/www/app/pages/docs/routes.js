window.angular.module('api')
.config(['$stateProvider', function($stateProvider){
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
}]);