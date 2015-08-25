var gulp = require('gulp');
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
    mix.copy('node_modules/angular/angular.js', 'resources/assets/js/01-angular.js');
    mix.copy('node_modules/angular-aria/angular-aria.js', 'resources/assets/js/02-angular-aria.js');
    mix.copy('node_modules/angular-animate/angular-animate.js', 'resources/assets/js/03-angular-animate.js');
    mix.copy('node_modules/angular-material/angular-material.js', 'resources/assets/js/04-angular-material.js');
    mix.copy('node_modules/angular-material/angular-material.scss', 'resources/assets/sass/angular-material.scss');
    mix.copy('node_modules/font-awesome/css/font-awesome.css', 'public/css/font-awesome.css');
    mix.copy('node_modules/angular-ui-router/release/angular-ui-router.js', 'resources/assets/js/05-angular-ui-router.js');
});

elixir(function(mix) {
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
});

elixir(function(mix) {
    mix.copy('resources/views/html', 'public/views');
});

gulp.task('copyHtml', function() {
    return gulp.src('resources/views/html/**').pipe(gulp.dest('public/views'));
});

elixir(function(mix) {
    mix.task('copyHtml', 'resources/views/html/**');
});

elixir(function(mix) {
    mix.sass(sass);
    mix.stylesIn('public/css', 'public/css/all.css');
});

elixir(function(mix){
    mix.scriptsIn('resources/assets/js', 'public/js');
});

//Copy bootstrap
elixir(function(mix){
    mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.css');
    mix.copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap.js');
});

//Copy sweet alert
elixir(function(mix){
    mix.copy('node_modules/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css');
    mix.copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.js');
});