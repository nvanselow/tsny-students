(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('AuthController', function(Auth, $state){

            var ctrl = this;

            ctrl.user = {email: '', password: '', remember: true};

            ctrl.login = function(){
                Auth.login(ctrl.user)
                .then(function(result){
                    //Success
                    $state.go('home');
                });
            };

            ctrl.logout = function(){
                Auth.logout();
            };

        });

}());