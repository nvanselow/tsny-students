(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('ApiInterceptor', ['$window', function($window){
            var interceptor = {};

            interceptor.responseError = function(response) {
                if (response.status === 401) {
                    console.log('not logged in.');
                    $window.location.href = '/auth/login';
                }

                if (response.state == 403) {
                    console.log('unauthorized for that action');
                    $window.location.href = '/auth/login';
                }
                return response;
            };

            return interceptor;
        }])

}());