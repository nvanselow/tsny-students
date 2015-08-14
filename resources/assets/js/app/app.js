(function () {

    'use strict';
    angular.module('TsnyApp', ['ngMaterial', 'TsnyControllers', 'TsnyConstants'])
        .config(function($mdThemingProvider) {
            $mdThemingProvider.theme('default')
                .primaryPalette('blue')
                .accentPalette('yellow')
                .warnPalette('red');
                //.backgroundPalette('deep-orange');
                //.dark();
        });

}());