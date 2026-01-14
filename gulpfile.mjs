import gulp from 'gulp';
import gulpSass from 'gulp-sass';
import dartSass from 'sass';
import sourcemaps from 'gulp-sourcemaps';
import cleanCSS from 'gulp-clean-css';
import autoprefixer from 'gulp-autoprefixer';
import gulpIf from 'gulp-if';
import yargs from 'yargs';
import { hideBin } from 'yargs/helpers';

const sass = gulpSass(dartSass);
const argv = yargs(hideBin(process.argv)).argv;
const production = !!argv.production;

gulp.task('sass', function () {
  return gulp.src('sass/style.scss')
    .pipe(gulpIf(!production, sourcemaps.init()))
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      overrideBrowserslist: ['last 2 versions'],
      cascade: false
    }))
    .pipe(gulpIf(production, cleanCSS()))
    .pipe(gulpIf(!production, sourcemaps.write()))
    .pipe(gulp.dest('./'));
});

gulp.task('watch', function () {
  gulp.watch('sass/style.scss', gulp.series('sass'));
});

gulp.task('default', gulp.series('sass', 'watch'));


/*
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function () {
  return gulp.src('sass/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'));
});

gulp.task('watch', function () {
  gulp.watch('sass/style.scss', gulp.series('sass'));
});

gulp.task('default', gulp.series('sass', 'watch'));
*/
