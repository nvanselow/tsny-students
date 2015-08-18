(function () {

    'use strict';

    angular.module('TsnyServices')
        .service('Goal', function($http, $mdDialog, $q){

            var Goal = {};

            Goal.addGoal = function(student){

                var deferred = $q.defer();

                $mdDialog.show({
                    controller: 'AddGoalDialogController as GoalCtrl',
                    templateUrl: 'views/goal_dialog.html',
                    parent: angular.element(document.body),
                    clickOutsideToClose:true,
                    locals: {
                        student: student
                    }
                })
                    .then(function(result) {
                        Goal.postGoal(result.student, result.goal)
                        .then(function(result){
                            //Success
                            deferred.resolve(result);
                            return result;

                        }, function(result){
                            //Error
                            deferred.reject(null);
                            return null;
                        });
                    }, function() {
                        deferred.reject(null);
                    });


                return deferred.promise;
            };

            Goal.postGoal = function(student, goal){
                return $http.post('api/student/' + student.id + '/goal', {goal:goal})
                .then(function(result){
                    //Success
                    return result.data.goal;

                }, function(result){
                    //Error
                    $q.reject(null);
                });
            };

            return Goal;

        })
        .controller('AddGoalDialogController', function($mdDialog, student){

            var ctrl = this;

            ctrl.student = student;

            ctrl.goal = {description:'', complete:false};

            ctrl.hide = function() {
                $mdDialog.hide();
            };
            ctrl.cancel = function() {
                $mdDialog.cancel();
            };
            ctrl.save = function() {
                $mdDialog.hide({student: ctrl.student, goal: ctrl.goal});
            };

        });

}());