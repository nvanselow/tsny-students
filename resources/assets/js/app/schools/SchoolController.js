(function () {

    'use strict';
    angular.module('TsnyControllers')
        .controller('SchoolsController', function(){
            var ctrl = this;

            ctrl.schools = [
                'Boston',
                'NYC',
                'Chicago',
                'Los Angeles',
                'DC'
            ];
        })

}());