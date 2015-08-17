(function () {

    'use strict';

    angular.module('TsnyServices')
        .service('Note', function($http, $mdDialog, $q){

            var Note = {};

            Note.addNote = function(student){

                var deferred = $q.defer();

                $mdDialog.show({
                    controller: 'AddNoteDialogController as NoteCtrl',
                    templateUrl: 'views/note_dialog.html',
                    parent: angular.element(document.body),
                    clickOutsideToClose:true,
                    locals: {
                        student: student
                    }
                })
                    .then(function(result) {
                        Note.postNote(result.student, result.note)
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

            Note.postNote = function(student, note){
                return $http.post('api/student/' + student.id + '/note', {note:note})
                .then(function(result){
                    //Success
                    return result.data.note;

                }, function(result){
                    //Error
                    $q.reject(null);
                });
            };

            return Note;

        })
        .controller('AddNoteDialogController', function($mdDialog, student){

            var ctrl = this;

            ctrl.student = student;

            ctrl.note = {note:''};

            ctrl.hide = function() {
                $mdDialog.hide();
            };
            ctrl.cancel = function() {
                $mdDialog.cancel();
            };
            ctrl.save = function() {
                $mdDialog.hide({student: ctrl.student, note: ctrl.note});
            };

        });

}());