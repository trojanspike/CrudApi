window.angular.module('api.dashboard', ['dashboard.controllers', 'dashboard.directives'])
.config(['$stateProvider', function($stateProvider){
    $stateProvider
    .state('dashboard', {
        url : '/dashboard',
        abstract : true,
        data : {},
        templateUrl : 'app/pages/dashboard/html/abstract.html'
    })
    .state('dashboard.home', {
        url : '',
        views : {
            main : {
                templateUrl : 'app/pages/dashboard/html/create.html',
                controller : 'uploadCreateCtl',
                controllerAs : 'ct'
            }
        }
    });
    
}]);