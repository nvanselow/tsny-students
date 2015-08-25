(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('Auth', function($http){

            var auth = {};

            auth.login = function(user){

                return $http.post('api/login', {user: user});

            };

            auth.logout = function(){
                return $http.get('api/logout');
            };

            return auth;

        });

}());