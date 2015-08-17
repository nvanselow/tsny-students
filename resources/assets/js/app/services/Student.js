(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('Student', function($http){
            var student = {};

            student.create = function(student){

                return $http.post('api/student', {student: student});

            };

            return student;
        });

}());