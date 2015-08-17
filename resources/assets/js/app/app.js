(function () {

    'use strict';
    angular.module('TsnyApp', ['ngMaterial', 'ui.router', 'ngMessages', 'TsnyControllers', 'TsnyConstants', 'TsnyServices'])
        .config(function($mdThemingProvider, $urlRouterProvider, $stateProvider) {
            $mdThemingProvider.theme('default')
                .primaryPalette('blue')
                .accentPalette('amber')
                .warnPalette('red');
                //.backgroundPalette('deep-orange');
                //.dark();

            // For any unmatched url, redirect to /state1
            $urlRouterProvider.otherwise("/");
            //
            // Now set up the states
            $stateProvider
                .state('home', {
                    url: "/",
                    templateUrl: "views/students.html",
                    controller: 'SchoolsController as SchoolsCtrl'
                })
                .state('add_student', {
                    url: "/schools/{school_id}/add-student",
                    templateUrl: "views/add_student.html",
                    controller: 'AddStudentController as StudentCtrl',
                    resolve: {
                        schools: function(School){
                            return School.all().then(function(data){
                                return data;
                            });
                        }
                    }
                })
                .state('student_detaisl', {
                    url: "/student/{student_id}",
                    templateUrl: "views/student_details.html",
                    controller: 'StudentController as StudentCtrl',
                    resolve: {
                        details: function(Student, $stateParams){
                            return Student.details($stateParams.student_id).then(function(data){
                                return data;
                            });
                        }
                    }
                })
                ;
        });

}());