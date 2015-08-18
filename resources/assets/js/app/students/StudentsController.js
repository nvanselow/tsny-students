(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('StudentController', function(Student, Note, Goal, Skill, $state, details){

            var ctrl = this;

            ctrl.student = details.student;
            ctrl.goals = details.goals;
            ctrl.skills = details.skills;
            ctrl.notes = details.notes;

            ctrl.addNote = function(){
                Note.addNote(ctrl.student)
                    .then(function(result){
                        //Success
                        ctrl.notes.unshift(result);
                    });
            };

            ctrl.addGoal = function(){
                Goal.addGoal(ctrl.student)
                    .then(function(result){
                        ctrl.goals.unshift(result);
                    });
            };

            ctrl.addSkill = function(){
                Skill.addSkill(ctrl.student)
                    .then(function(result){
                        ctrl.skills.unshift(result);
                    });
            };

        })
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