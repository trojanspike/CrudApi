window.angular.module('api')
.config(['$httpProvider' , function($httpProvider){
    
    $httpProvider.interceptors.push('userRequest');
    
}])

.factory('userRequest', function($q, Session){
    var LANG = window.navigator.language,
        FINGER_PRINT;
        new Fingerprint2().get(function(result){
            FINGER_PRINT = result;
        });
    // window.navigator.language
    return {
            request : function(conf){
                conf.headers['Accept']='application/json';
                conf.headers['Auth-token']=Session.get('authToken');
                conf.headers['_csrf']=Session.get('_csrf');

                /* add Some other data we need for on server */
                conf.data = conf.data || {};
                conf.data.__extra__ = {
                    lang : LANG,
                    fingerPrint : FINGER_PRINT,
                    timeStamp : new Date().getTime()
                };
                return conf;
            },
            response : function(conf){
                return conf;
            },
            responseError : function(rejection) {
                return $q.reject(rejection);
            }
        };
    
});