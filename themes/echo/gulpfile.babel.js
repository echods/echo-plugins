'use strict';

import gulp from 'gulp';
import pump from 'pump';
import sass from 'gulp-sass';
import babel from 'gulp-babel';
import concat from 'gulp-concat';
import jshint from 'gulp-jshint';
import notify from 'gulp-notify';
import uglify from 'gulp-uglify';
import stylish from 'jshint-stylish';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'gulp-autoprefixer';
import requirejs from 'requirejs';
// import autoprefixer from 'gulp-autoprefixer';

// var gulp = require('gulp');
// var babel = require('gulp-babel');


/*
* https://babeljs.io/docs/usage/polyfill/
* Note: Depending on what ES2015 methods you actually use,
* you may not need to use babel-polyfill or the runtime plugin.
* -------------------------------------------------------------
*/
const assets = './assets'
const source = './resources/assets'

// c = config
const c = {
  paths: {
    sassSrc: `${source}/sass/**/*.scss`,
    sassDest: `${assets}/css`,
    jsNonNpmVendor: `${source}/js/vendor`,
    jsSrc: `${source}/js`,
    jsVendorSrc: `${source}/js/vendor`,
    jsDest: `${assets}/js/`
  },
  sassOpts: {
    outputStyle: 'compressed',
    errLogToConsole: true
  },
  prefixerOpts: {
    browsers: ['last 2 versions']
  },
  // vendorOrder: [
  //   // `${source}/js/vendor/skip-link-focus-fix.js`,
  //   // `${source}/js/vendor/functions.js`
  // ],
  scriptsToMovie: [
    `${source}/js/vendor/color-scheme-control.js`,
    `${source}/js/vendor/customize-preview.js`,
    `${source}/js/vendor/keyboard-image-navigation.js`
  ]
}

// Sass task to compile
gulp.task('sass', () => {
  return gulp
    .src(c.paths.sassSrc)
    .pipe(sourcemaps.init())
    .pipe(sass(c.sassOpts).on('error', sass.logError))
    .pipe(autoprefixer(c.prefixerOpts))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(c.paths.sassDest))
    .pipe(notify('Sass compiled. Complete.'));
});

// Compile all js vendor files
gulp.task('scriptsVendor', (cb) => {
  // return gulp.src(`${c.paths.jsSrc}/vendors.js`)
  // .pipe(babel())
  // .pipe(gulp.dest(c.paths.jsDest))
  pump([
    gulp.src(`${c.paths.jsSrc}/vendors.js`),
    sourcemaps.init(),
    babel(),
    require(),
  //   concat('vendors.min.js'),
    uglify(),

    sourcemaps.write('.'),
  //   gulp.dest(c.paths.jsDest),
  ],
  cb
  );
});

// Application scripts
gulp.task('scripts', ['lint'], () => {
  return gulp.src(`${c.paths.jsSrc}/app.js`)
  .pipe(babel())
  .pipe(gulp.dest(c.paths.jsDest))
  // pump([
  //   gulp.src(`${c.paths.jsSrc}/app.js`),
  //   sourcemaps.init(),
  //   babel(),
  //   // concat('app.min.js'),
  //   // uglify(),
  //   sourcemaps.write('.'),
  //   gulp.dest(c.paths.jsDest),
  // ],
  // cb
  // );
});

// Lint for script checking
gulp.task('lint', () => {
  return gulp.src(`{c.paths.jsSrc}/app.js`)
    .pipe(jshint())
    .pipe(jshint.reporter(stylish))
    .pipe(jshint.reporter('fail'));
});

gulp.task('watch', () => {

  // Watch css changes
  gulp.watch(c.paths.sassSrc, ['sass'])
   .on('change', (e) => {
     console.log(`File ${e.path} was ${e.type}, running Sass task..`);
   });

  // Watch script changes
  gulp.watch([
      `!${c.paths.jsVendorSrc}/**`,
      `${c.paths.jsSrc}/**/*.js`
    ], ['scripts'])
   .on('change', (e) => {
     console.log(`File ${e.path} was ${e.type}, running Sass task..`);
   });
});

gulp.task('moveScripts', () => {
  return gulp.src(c.scriptsToMovie)
    .pipe(gulp.dest('./assets/js/vendor'));
});

gulp.task('build', ['sass', 'scriptsVendor', 'scripts', 'moveScripts']);
gulp.task('default', ['build']);
