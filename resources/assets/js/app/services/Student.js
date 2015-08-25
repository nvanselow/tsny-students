(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('Student', function($http, $q){
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

            student.search = function(search_text){

                var deferred = $q.defer();

                if(!search_text || !search_text.length){
                    deferred.reject([]);
                } else {
                    $http.get('api/student/search/' + search_text)
                        .then(function(result){
                            //Success
                            deferred.resolve(result.data);
                        }, function(result){
                            //Error
                            deferred.reject(result);
                        });
                }

                return deferred.promise;
            };

            return student;
        });

}());