(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('SchoolsController', function(){
            var ctrl = this;

            ctrl.user_info = {
                current_school: {"id":2,"name":"Chicago"}
            };

            ctrl.schools = [{"id":1,"name":"Boston"},{"id":2,"name":"Chicago"},{"id":3,"name":"NYC"},{"id":4,"name":"DC"},{"id":5,"name":"Los Angeles"}];

            ctrl.school_changed = function(){
                ctrl.user_info.current_school.name = _.find(ctrl.schools, function(school){
                    return school.id == ctrl.user_info.current_school.id;
                }).name;
            };
        })

}());