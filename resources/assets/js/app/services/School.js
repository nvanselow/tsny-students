(function () {

    'use strict';
    angular.module('TsnyServices')
        .service('School', function($http, $q){

            var school = {};

            school.schools = null;

            school.all = function(refresh){
                var deferred = $q.defer();

                if(!refresh && school.schools){
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

            return school;

        });

}());