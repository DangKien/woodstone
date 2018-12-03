ngApp.directive('myDatepicker', function($apply) {
    return {
        restrict: 'C',
        link: function(scope, element, attrs) {
            $apply(function () {
                $('.datepicker').datepicker();
                $('#sandbox-container input').datepicker({
                    language: "vi"
                });
            });
        }
    };
});

ngApp.directive('isSwChecked', function ($apply) {
    return {
        restrict: 'C',
        link: function(scope, element, attrs) {
            $apply(function () {
                new Switchery(element[0]);
                element[0].onchange = function(event) {
                    scope.$eval(attrs.ngClick);
                    event.preventDefault();
                };
            });
        }
    };
});