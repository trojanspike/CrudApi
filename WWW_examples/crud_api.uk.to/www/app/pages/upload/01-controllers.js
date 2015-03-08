window.angular.module('upload.controllers', [])
.controller('uploadCreateCtl', [function(){
    
    this.data = {
        head : 'Upload'+new Date().getTime()
    };
    
}]);