window.angular.module('upload.directives', [])
.directive('upload', [function(){
    
    return {
        restrict : 'E',
        template : '<form>@@form {{ vt.info }} @@</form>',
        controller : function(){
            this.info = '@info';
        },
        controllerAs : 'vt'
    };
    
}]);