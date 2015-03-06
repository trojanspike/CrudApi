window.angular.module('api', ['ui.router'])

/* user info service */
/* TODO - use l-storage to save authToken */
/* Should prob call this Session  */
.factory('userInfo', function($rootScope){
    var info = { authToken : false, loggedin : false, _csrf : false };
    return {
        getAll : function(){
            return info;
        },
        get : function(key){
            return info[key];
        },
        reset : function(){
            var csrf = (typeof info['_csrf'] !== 'undefined')?info['_csrf']:false;
            info = { authToken : false, loggedin : false, _csrf : csrf };
        },
        set : function(obj){
            info = angular.extend( info , obj );
        }
    };
})


/* CSRF value */
.directive('apiCsrf', function(){
    return {
        restrict : 'A',
        controller : function($attrs, userInfo){
            userInfo.set({
                _csrf : $attrs.apiCsrf
            });
        }
    }
})


/* Controller */
.controller('UserInfoCtl' , ['userInfo','$timeout', '$scope', '$http', 
function(userInfo, $timeout , $scope, $http){
    $scope.fn = {};
    $scope.data = {};
    $scope.data.userInfo = userInfo.getAll();
    
    $scope.$watch( 'data.userInfo.authToken' , function(_new, _old){
        localStorage.setItem('Session', JSON.stringify({
            authToken : _new,
            loggedin : (typeof _new === 'string')
        }));
    } );
    
    $scope.fn.logout = function(){
        $http.delete('http://crud-api.uk.to/v1/Session', {uid : userInfo.get('user_id')}).then(function(data){
            userInfo.reset();
            $scope.$emit('logout');
        });
    };
    
    $scope.message = true
    $scope.quote = "#";
    
    $scope.fn.noAuth = function(){
        $http.get('http://crud-api.uk.to/v1/Quotes-NoAuth').then(function(data){
            $scope.quote = data.data;
        });
    }
    
    $scope.fn.Auth = function(){
        $http.get('http://crud-api.uk.to/v1/Quotes-Auth').then(function(data){
            userInfo.set({
                authToken : ( typeof data.data.authToken !== 'undefined' )?data.data.authToken:false
            });
            $scope.quote = data.data;
        });
    }
    
    $scope.$on('LoggedIn' , function(){
        $scope.message = 'You\'re logged in';
        $timeout(function(){
            $scope.message  = true
        }, 3000);
    });
    
    $scope.$on('logout' , function(){ 
        $scope.data.userInfo = userInfo.getAll();
    });
    
}])

.run(function($rootScope, $templateCache, userInfo, $state) {

    $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
        
        if( typeof(toState.data.sessionRequired) !== 'undefined' && toState.data.sessionRequired !== userInfo.get('loggedin')  ){
            
                event.preventDefault();
                $rootScope.$broadcast('LoggedIn');
                $state.go('docs.v1');
            }
        });
    
    try {
        var Sess = JSON.parse( localStorage.getItem('Session') );
        userInfo.set(Sess);
        }
        catch(err) {}
    
   $rootScope.$on('$viewContentLoaded', function() {
      $templateCache.removeAll();
   });
});