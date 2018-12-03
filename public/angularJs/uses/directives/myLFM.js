ngApp.directive('myLfm', function($apply) {
    return {
        restrict: 'C',
        scope: {
            type: "=type"
        },
        link: function(scope, element, attrs) {
            if (!scope.type) {
                scope.type = "image";
            }
            var domain = SiteUrl + '/admin/laravel-filemanager';
            $(element).filemanager(scope.type, {prefix: domain});
        }
    };
});