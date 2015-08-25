(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('Auth', function($http, $window){

            var auth = {};

            auth.login = function(user){

                return $http.post('api/login', {user: user});

            };

            auth.logout = function(){
                return $http.get('/auth/logout')
                .then(function(result){
                    //Success
                    $window.location.href = '/auth/login';

                }, function(result){
                    //Error

                });
            };

            return auth;

        });

}());