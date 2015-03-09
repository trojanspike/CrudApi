window.angular.module('api')
.config(['$httpProvider' , function($httpProvider){
    
    $httpProvider.interceptors.push('userRequest');
    
}])

.factory('userRequest', function($q, userInfo){
    
    return {
        request : function(conf){
            conf.headers['Accept']='application/json';
            conf.headers['Auth-token']=userInfo.get('authToken');
            conf.headers['_csrf']=userInfo.get('_csrf');
            return conf;
        }
        };
    
});