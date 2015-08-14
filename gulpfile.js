var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var js = [
    'angular.js',
    'angular-aria.js',
    'angular-animate.js',
    'angular-material.js'
];

var sass = [
    'angular-material.scss',
    'app.scss'
];

elixir(function(mix) {
    mix.sass(sass);
});

elixir(function(mix) {
    mix.copy('node_modules/angular/angular.js', 'resources/assets/js/01-angular.js');
    mix.copy('node_modules/angular-aria/angular-aria.js', 'resources/assets/js/02-angular-aria.js');
    mix.copy('node_modules/angular-animate/angular-animate.js', 'resources/assets/js/03-angular-animate.js');
    mix.copy('node_modules/angular-material/angular-material.js', 'resources/assets/js/04-angular-material.js');
    mix.copy('node_modules/angular-material/angular-material.scss', 'resources/assets/sass/angular-material.scss');
});

elixir(function(mix){
    mix.scriptsIn('resources/assets/js', 'public/js');
});
