window.angular.module('api')
.config(['$stateProvider', function($stateProvider){
    $stateProvider
        .state('user', {
            url : '/user',
            abstract: true,
            templateUrl : 'app/pages/user/html/abstract.html',
            data : {
                sessionRequired : false
            }
        })
        .state('user.login', {
            url : '/login',
            views : {
                main : {
                    templateUrl : 'app/pages/user/html/login.html',
                    controller : 'Login'
                }
            }
        }).state('user.create', {
            url : '/create',
            views : {
                main : {
                    templateUrl : 'app/pages/user/html/create.html',
                    controller : 'LoginCreate'
                }
            }
        });
}]);