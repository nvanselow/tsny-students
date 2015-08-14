(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('SchoolsController', function(UserInfo, School){
            var ctrl = this;

            ctrl.user_info = UserInfo;

            ctrl.loading = true;

            //ctrl.schools = [{"id":1,"name":"Boston"},{"id":2,"name":"Chicago"},{"id":3,"name":"NYC"},{"id":4,"name":"DC"},{"id":5,"name":"Los Angeles"}];

            ctrl.schools = [];


            School.all().then(function(result){
                    ctrl.schools = result;
                })
                .finally(function(){
                    ctrl.loading = false;
                });

            ctrl.school_changed = function(){
                ctrl.user_info.current_school.name = _.find(ctrl.schools, function(school){
                    return school.id == ctrl.user_info.current_school.id;
                }).name;
            };
        })

}());