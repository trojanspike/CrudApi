window.angular.module('api.upload', ['upload.controllers', 'upload.directives'])
.config(['$stateProvider', function($stateProvider){
    console.log($stateProvider)
    $stateProvider
    .state('upload', {
        url : '/upload',
        abstract : true,
        data : {},
        templateUrl : 'app/pages/upload/html/abstract.html'
    })
    .state('upload.home', {
        url : '',
        views : {
            main : {
                templateUrl : 'app/pages/upload/html/home.html',
                controller : 'uploadCreateCtl',
                controllerAs : 'ct'
            }
        }
    });
    
}]);