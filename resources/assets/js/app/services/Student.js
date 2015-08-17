(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('Student', function($http){
            var student = {};

            student.create = function(student){

                return $http.post('api/student', {student: student});

            };

            student.details = function(student_id){

                return $http.get('api/student/' + student_id)
                .then(function(result){
                    //Success
                    return {
                        student: result.data.student,
                        goals: result.data.details.goals,
                        skills: result.data.details.skills,
                        notes: result.data.details.notes
                    };

                }, function(result){
                    //Error
                    return null;
                });

            };

            return student;
        });

}());