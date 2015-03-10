window.angular.module('api')
.controller('LoginCreate', ['$scope', '$http' , '$state', '$rootScope', 
function($scope , $http, $state, $rootScope){
    $scope.fn = {};
    $scope.form = {};
    
    $scope.fn.create = function(){
        $http.post('/v1/user', $scope.form).then(function(data){
            var result = data.data;
            if( result.error === false ){
                $state.go('user.login');
            } else {
                alert('@error POST/v1/user');
                console.log(result);
            }
        });
    };
    
}])
.controller('Login', ['$scope', '$http' , 'userInfo', '$state', '$rootScope', 
function($scope , $http, userInfo, $state, $rootScope){
    $scope.fn = {};
    $scope.form = {};
    $scope.message = '';
    
    $scope.fn.login = function(){
        /* Should prob be in #POST /Session [create-session]*/
        $http.post('/v1/Session', $scope.form).then(function(data){
            console.log(data);
            var result = data.data;
            if( result.error === false ){
                userInfo.set(result);
                userInfo.set({
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