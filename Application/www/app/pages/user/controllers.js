window.angular.module('api')
.controller('LoginCreate', ['$scope', '$http' , '$state', '$rootScope', 
function($scope , $http, $state, $rootScope){
    $scope.fn = {};
    $scope.form = {};
    
    $scope.fn.create = function(){
        $http.post('/v1/users', $scope.form).then(function(data){
            var result = data.data;
            if( result.error === false ){
                $state.go('user.login');
            } else {
                alert('@error POST/v1/users');
                console.log(result);
            }
        });
    };
    
}])
.controller('Login', ['$scope', '$http' , 'Session', '$state', '$rootScope', 
function($scope , $http, Session, $state, $rootScope){
    $scope.fn = {};
    $scope.form = {};
    $scope.message = '';
    
    $scope.fn.login = function(){
        /* Should prob be in #POST /Session [create-session]*/
        $http.post('/v1/session', $scope.form).then(function(data){
            console.log(data);
            var result = data.data;
            if( result.error === false ){
                Session.set(result);
                Session.set({
                    loggedin : true
                });
                $rootScope.$broadcast('LoggedIn'); 
                $state.go('docs.session'); 
            } else {
                $scope.message = 'User not Found';
            }
        });
    };
    
}]);
