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
  vendorOrder: [
    `${source}/js/vendor/html5.js`,
    `${source}/js/vendor/functions.js`,
    `${source}/js/vendor/customize-preview.js`,
    `${source}/js/vendor/skip-link-focus-fix.js`,
    `${source}/js/vendor/color-scheme-control.js`,
    `${source}/js/vendor/keyboard-image-navigation.js`,
  ]
}

// Sass task to compile
gulp.task('sass', () => {
  return gulp
    .src(c.paths.sassSrc)
    .pipe(sourcemaps.init())
    .pipe(sass(c.sassOpts).on('error', sass.logError))
    .pipe(autoprefixer(c.prefixerOpts))
    .pipe(sourcemaps.write(c.paths.sassDest))
    .pipe(gulp.dest(c.paths.sassDest))
    .pipe(notify('Sass compiled. Complete.'));
});

// Compile all js vendor files
gulp.task('scriptsVendor', (cb) => {
  pump([
    gulp.src( c.vendorOrder ),
    concat('vendors.min.js'),
    uglify(),
    gulp.dest( c.paths.jsDest )
  ],
  cb
  );
});

gulp.task('scripts', ['lint'], () => {
return gulp.src([
      `!${c.paths.jsVendorSrc}/**`,
      `${c.paths.jsSrc}/**/*.js`
    ])
    .pipe(sourcemaps.init())
    .pipe(babel())
    .pipe(concat("app.min.js"))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(c.paths.jsDest));
});

gulp.task('lint', () => {
  return gulp.src(`c.paths.jsSrc/app.js`)
    .pipe(jshint())
    .pipe(jshint.reporter(stylish))
    .pipe(jshint.reporter('fail'));
});

gulp.task('watch', () => {
  gulp.watch(c.paths.sassSrc, ['sass'])
   .on('change', (e) => {
     console.log(`File ${e.path} was ${e.type}, running Sass task..`);
   });

  gulp.watch(`c.paths.jsSrc/**/*.js`, ['scripts'])
   .on('change', (e) => {
     console.log(`File ${e.path} was ${e.type}, running Sass task..`);
   });
});

gulp.task('build', ['sass', 'scriptsVendor', 'scripts']);
gulp.task('default', ['build']);
