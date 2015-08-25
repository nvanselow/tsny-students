(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('School', ['$http', '$q', function($http, $q){

            var school = {};

            school.schools = [];
            school.students = [];

            school.all = function(refresh){
                var deferred = $q.defer();

                if(!refresh && school.schools && school.schools.length){
                    console.log('schools already exist');
                    deferred.resolve(school.schools);
                    return deferred.promise;
                }

                $http.get('api/schools')
                    .then(function(result){
                        //Success
                        school.schools = result.data;
                        deferred.resolve(result.data);
                    }, function(result){
                        //Error
                        console.log('Error!');
                        console.log(result);
                        school.schools = [];
                        deferred.reject([]);
                    });

                console.log('got schools from http');

                return deferred.promise;
            };

            school.updateStudents = function(school_id){

                return $http.get('api/schools/' + school_id + '/students')
                .then(function(result){
                    //Success
                    school.students = result.data;
                    return result.data;

                }, function(result){
                    //Error
                    console.log('error obtaining students for this school.');
                    school.students = [];
                    return [];
                });
            };

            school.updateStudentsWithSummaries = function(school_id){

                return $http.get('api/schools/' + school_id + '/students/summaries')
                    .then(function(result){
                        //Success
                        school.students = result.data;
                        return result.data;

                    }, function(result){
                        //Error
                        console.log('error obtaining students for this school.');
                        school.students = [];
                        return [];
                    });
            };

            return school;

        }]);

}());