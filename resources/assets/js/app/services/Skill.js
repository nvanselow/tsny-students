(function () {

    'use strict';

    angular.module('TsnyServices')
        .service('Skill', function($http, $mdDialog, $q){

            var Skill = {};

            Skill.addSkill = function(student){

                var deferred = $q.defer();

                $mdDialog.show({
                    controller: 'AddSkillDialogController as SkillCtrl',
                    templateUrl: 'views/skill_dialog.html',
                    parent: angular.element(document.body),
                    clickOutsideToClose:true,
                    locals: {
                        student: student
                    }
                })
                    .then(function(result) {
                        Skill.postSkill(result.student, result.skill)
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

            Skill.postSkill = function(student, skill){
                return $http.post('api/student/' + student.id + '/skill', {skill:skill})
                .then(function(result){
                    //Success
                    return result.data.skill;

                }, function(result){
                    //Error
                    $q.reject(null);
                });
            };

            Skill.toggleCurrentSkill = function(skill){
                return $http.post('api/skill/' + skill.id + '/toggle', {})
                .then(function(result){
                    //Success
                    skill.current = result.data.current;
                    return skill;
                }, function(result){
                    //Error
                    return result;
                });
            };

            return Skill;

        })
        .controller('AddSkillDialogController', function($mdDialog, student){

            var ctrl = this;

            ctrl.student = student;

            ctrl.skill = {name:'', proficiency:0, current:false, note:''};

            ctrl.hide = function() {
                $mdDialog.hide();
            };
            ctrl.cancel = function() {
                $mdDialog.cancel();
            };
            ctrl.save = function() {
                $mdDialog.hide({student: ctrl.student, skill: ctrl.skill});
            };

        });

}());