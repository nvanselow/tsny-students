(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('AddStudentController', function($stateParams, schools, Student){

            var ctrl = this;

            ctrl.schools = schools;

            ctrl.student = {
                first_name: '',
                last_name: '',
                nickname: '',
                email: '',
                primary_school: $stateParams.school_id
            };

            ctrl.addStudent = function(){

            };

            ctrl.cancel = function(){

            };

        });

}());