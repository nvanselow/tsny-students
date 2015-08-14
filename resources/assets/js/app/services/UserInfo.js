(function () {

    'use strict';

    angular.module('TsnyServices')
        .service('UserInfo', function(){
            var user_info = {};

            user_info.current_school = {"id":2,"name":"Chicago"};

            return user_info;
        })

}());