(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('AddStudentController', function($stateParams, schools, Student, $state){

            var ctrl = this;

            ctrl.schools = schools;

            ctrl.student = {
                first_name: '',
                last_name: '',
                nickname: '',
                email: '',
                primary_school: $stateParams.school_id,
                schools: []
            };

            ctrl.toggle_school = function (school_id) {
                var list = ctrl.student.schools;
                var item = school_id;

                var idx = list.indexOf(item);
                if (idx > -1) list.splice(idx, 1);
                else list.push(item);
            };
            ctrl.school_exists_in_list = function (school_id) {
                var list = ctrl.student.schools;
                var item = school_id;

                return list.indexOf(item) > -1;
            };

            ctrl.adding_student = false;
            ctrl.addStudent = function(){
                ctrl.adding_student = true;
                Student.create(ctrl.student)
                    .then(function(result){
                        //Success
                        $state.go('home');

                    }, function(result){
                        //Error

                    })
                    .finally(function(){
                        ctrl.adding_student = false;
                    });
            };

            ctrl.cancel = function(){

            };

        });

}());