(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('ApiInterceptor', function(){
            var interceptor = {};

            interceptor.responseError = function(response) {
                if (response.status === 401) {
                    console.log('not logged in.')
                }

                if (response.state == 403) {
                    console.log('unauthorized for that action')
                }
                return response;
            };

            return interceptor;
        })

}());