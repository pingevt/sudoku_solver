var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var minifycss = require('gulp-minify-css');
var cleanCSS = require('gulp-clean-css');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

var paths = {
    styles: ['./scss/style.scss']
}

gulp.task('css', function ()
{
  gulp.src(paths.styles)
    .pipe(plumber())
    .pipe(sass())
    .pipe(minifycss())
    .pipe(autoprefixer({ browsers: ['last 3 versions'] }))
    .pipe(gulp.dest(''))
    .pipe(notify({message: 'SCSS Compiled!'}));
});

gulp.task('watch', function ()
{
  gulp.watch('./scss/*.scss', ['css']);
  gulp.watch('./scss/**/*.scss', ['css']);
});

gulp.task('default', ['watch']);