'use strict';

import gulp from 'gulp';
import sass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import sourcemaps from 'gulp-sourcemaps';
import uglify from 'gulp-uglify';
import pump from 'pump';
import jshint from 'gulp-jshint';
import stylish from 'jshint-stylish';
import notify from 'gulp-notify';

/*
* https://babeljs.io/docs/usage/polyfill/
* Note: Depending on what ES2015 methods you actually use,
* you may not need to use babel-polyfill or the runtime plugin.
* -------------------------------------------------------------
*/
// import 'babel-polyfill';

const assets = './assets'
const source = './resources/assets'

// c = config
const c = {
  paths: {
    sassSrc: `${source}/sass/**/*.scss`,
    sassDest: `${assets}/css`,
    jsNonNpmVendor: `${source}/js/vendor`,
    jsSrc: `${source}/js/app.js`,
    jsDest: `${assets}/js/app.js`
  },
  sassOpts: {
    outputStyle: 'compressed',
    errLogToConsole: true
  },
  prefixerOpts: {
    browsers: ['last 2 versions']
  },
  vendorOrder: [
    'file1.js',
    'file2.js'
  ]
}

// Sass task to compile
gulp.task('sass', () => {
  return gulp
    .src( c.paths.sassSrc )
    .pipe( sourcemaps.init() )
    .pipe( sass( c.sassOpts ).on('error', sass.logError) )
    .pipe( autoprefixer( c.prefixerOpts ) )
    .pipe( sourcemaps.write() )
    .pipe( gulp.dest( c.paths.sassDest ) )
    .pipe( notify('Sass file ran correctly') );
});

gulp.task('lint', function() {
  return gulp.src( c.paths.jsSrc )
    .pipe( jshint() )
    .pipe( jshint.reporter(stylish) )
    .pipe( jshint.reporter('fail') );
});

gulp.task('scriptsVendor', function() {
  return gulp.src( c.vendorOrder )
    .pipe(gulp.dest( c.paths.jsDest ));
});

gulp.task('scripts', () => {
  return gulp.src("src/**/*.js")
    .pipe(sourcemaps.init())
    .pipe(babel())
    .pipe(concat("all.js"))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest("dist"));
});


//gulp.task('watch', () => {
  //gulp.watch('./src/sass/**/*.scss', ['sass'])
   //.on('change', (e) => {
// console.log(`File ${e.path} was ${e.type}, running Sass task..`);
     //console.log('test'); // Template strings and interpolation!!
// e.path, e.type
   //});
//});

// https://github.com/terinjokes/gulp-uglify/blob/master/docs/why-use-pump/README.md#why-use-pump
//var gulp = require('gulp');
//var uglify = require('gulp-uglify');
//var pump = require('pump');

//gulp.task('compress', function (cb) {
  //pump([
        //gulp.src('lib/*.js'),
        //uglify(),
        //gulp.dest('dist')
    //],
    //cb
  //);
//});

gulp.task('build', ['sass', 'scriptsVendor', 'scripts']);
gulp.task('default', ['build']);
