
(function(angular, undefined){
    
    angular.module('rest-example', [])
    .config([function(){}])
    .controller('Main', ["$scope", function($scope){
        
        $scope.data = {
            name : 'Lee'
        };
        
    }]);
    
})(window.angular);