(function () {

    'use strict';

    angular.module('TsnyServices')
        .service('UserInfo', function(Auth){
            var user_info = {};

            user_info.current_school = {"id":1,"name":"Boston"};

            user_info.logout = function(){
                Auth.logout();
            };

            return user_info;
        })

}());