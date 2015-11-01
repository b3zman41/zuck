var elixir = require('laravel-elixir');
var gulp = require('gulp');
var browserSync = require('browser-sync');
var connect = require('gulp-connect-php');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var minifyCss = require('gulp-minify-css');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

 gulp.task('styles', function () {
        return gulp.src('./public/scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(minifyCss({compatibility: 'ie8'}))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./public/scss/'));
    });

 gulp.task('watch', function () {
    // gulp.watch('./public/scss/**/*.scss', ['styles', browserSync.reload]);
    // gulp.watch('./public/scss/main.scss', ['styles', browserSync.reload]);
    // gulp.watch('./public/scripts/*.js', [browserSync.reload]);
    // gulp.watch('./public/scripts/**/*', [browserSync.reload]);
    // gulp.watch('./public/index.html', [browserSync.reload]);
    // gulp.watch('./public/views/**/*.html', [browserSync.reload]);
    // gulp.watch('./public/views/*.html', [browserSync.reload]);
    // gulp.watch('./public/views/*.html', [browserSync.reload]);
    // gulp.watch('./resources/views/**/*', [browserSync.reload]);
    // gulp.watch('./app/**/*', [browserSync.reload]);
});

 gulp.task('no-watch', function () {
    gulp.watch('./public/scss/**/*.scss', [browserSync.reload]);
    gulp.watch('./public/scss/main.scss', [browserSync.reload]);
    gulp.watch('./public/scripts/*.js', [browserSync.reload]);
    gulp.watch('./public/scripts/**/*', [browserSync.reload]);
    gulp.watch('./public/index.html', [browserSync.reload]);
    gulp.watch('./public/views/**/*.html', [browserSync.reload]);
    gulp.watch('./public/views/*.html', [browserSync.reload]);
    gulp.watch('./public/views/*.html', [browserSync.reload]);
    gulp.watch('./resources/views/**/*', [browserSync.reload]);
});

 gulp.task('browser-sync', function () {
    connect.server({
        base: './public'
    }, function () {
        browserSync({
            notify: false,
            open: false,
            proxy: "localhost:8000"
        })
    });
});

 gulp.task('default', ['styles', 'watch', 'browser-sync']);
 gulp.task('no', ['no-watch', 'browser-sync']);
