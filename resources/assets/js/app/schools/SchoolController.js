(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('SchoolsController', function(UserInfo, School){
            var ctrl = this;

            ctrl.user_info = UserInfo;

            ctrl.loading = true;

            //ctrl.schools = [{"id":1,"name":"Boston"},{"id":2,"name":"Chicago"},{"id":3,"name":"NYC"},{"id":4,"name":"DC"},{"id":5,"name":"Los Angeles"}];

            ctrl.School = School;

            ctrl.loading_students = false;

            School.all()
                .finally(function(){
                    ctrl.loading = false;
                });

            ctrl.school_changed = function(){
                ctrl.user_info.current_school.name = _.find(ctrl.School.schools, function(school){
                    return school.id == ctrl.user_info.current_school.id;
                }).name;

                ctrl.update_student_list(ctrl.user_info.current_school.id);
            };

            ctrl.update_student_list = function(school_id){
                ctrl.loading_students = true;
                School.updateStudentsWithSummaries(school_id)
                    .finally(function(){
                        ctrl.loading_students = false;
                    });
            };

            if(ctrl.user_info.current_school){
                ctrl.update_student_list(ctrl.user_info.current_school.id);
            }
        })

}());