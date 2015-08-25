var gulp = require('gulp');
var elixir = require('laravel-elixir');
var minifyCss = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var minifyHTML = require('gulp-minify-html');

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
    mix.copy('node_modules/angular/angular.js', 'resources/assets/vendor/01-angular.js');
    mix.copy('node_modules/angular-aria/angular-aria.js', 'resources/assets/vendor/02-angular-aria.js');
    mix.copy('node_modules/angular-animate/angular-animate.js', 'resources/assets/vendor/03-angular-animate.js');
    mix.copy('node_modules/angular-material/angular-material.js', 'resources/assets/vendor/04-angular-material.js');
    mix.copy('node_modules/angular-material/angular-material.scss', 'resources/assets/sass/angular-material.scss');
    mix.copy('node_modules/font-awesome/css/font-awesome.css', 'public/css/font-awesome.css');
    mix.copy('node_modules/angular-ui-router/release/angular-ui-router.js', 'resources/assets/vendor/05-angular-ui-router.js');
    mix.copy('node_modules/angular-messages/angular-messages.js', 'resources/assets/vendor/06-angular-messages.js');
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
});

elixir(function(mix){
    mix.scriptsIn('resources/assets/js', 'public/js');
    mix.scriptsIn('resources/assets/vendor', 'public/js/lib.js');
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

gulp.task('minify_css', function(){
    return gulp.src('public/css/app.css')
        .pipe(minifyCss())
        .pipe(gulp.dest('public/css'));
});

gulp.task('minify_js', function(){
    return gulp.src('public/js/all.js')
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('minify_html', function(){
    var opts = {
        conditionals: true,
        spare:true
    };

    return gulp.src('public/views/*.html')
        .pipe(minifyHTML(opts))
        .pipe(gulp.dest('public/views'));
});

gulp.task('production', ['minify_css', 'minify_js', 'minify_html']);