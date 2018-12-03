ngApp.factory('$myNotify', ['$rootScope', function ($rootScope) {
    var myNotify = {
        success: function() {
            var heading   = headingNotifi.success;
            var text      = messageNotifi.success;
            var position  = position || 'top-right';
            var loaderBg  = '#c6ede0';
            var icon      = 'success';
            var hideAfter = 3000;
            var stack     = 1;
            $.toast({ heading: heading,
                      text: text,
                      position: position,
                      loaderBg: loaderBg, 
                      icon: icon, 
                      hideAfter: hideAfter,
                      stack: stack,
                  });
        },
        error: function() {
            var heading   = headingNotifi.failue;
            var text      = messageNotifi.failue;
            var position  = position || 'top-right';
            var loaderBg  = '#fcd8dc';
            var bgColor   = '#fcd8dc';
            var icon      = 'error';
            var hideAfter = 3000;
            var stack     = 1;
            console.log(text)
            $.toast({ heading: heading,
                      text: text,
                      position: position,
                      loaderBg: loaderBg, 
                      icon: icon, 
                      hideAfter: hideAfter,
                      stack: stack,
                  });
        },

        warning: function() {
            var heading   = headingNotifi.warning;
            var text      = messageNotifi.warning;
            var position  = position || 'top-right';
            var loaderBg  = '#c6ede0';
            var icon      = 'warning';
            var hideAfter = 3000;
            var stack     = 1;
            $.toast({ heading: heading,
                      text: text,
                      position: position,
                      loaderBg: loaderBg, 
                      icon: icon, 
                      hideAfter: hideAfter,
                      stack: stack,
                  });
        },
    };
        
        return myNotify;
}]);
