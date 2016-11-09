'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

var paths = {
    sass: './resources/scss/**/*.scss',
    js: './resources/js/**/*.js'
};

gulp.task('sass', function () {
    return gulp.src(paths.sass)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./public/css'))
    ;
});

gulp.task('js', function () {
    return gulp.src(paths.js)
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./public/js'))
    ;
});

gulp.task('watch', function () {
    gulp.watch(paths.sass, ['sass']);
    gulp.watch(paths.js, ['js']);
});

gulp.task('default', ['sass', 'js']);