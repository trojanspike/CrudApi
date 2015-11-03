window.angular.module('dashboard.controllers', [])
.controller('uploadCreateCtl', [function(){
    
    this.data = {
        head : 'dashboard'+new Date().getTime()
    };
    
}]);