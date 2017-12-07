'use strict';

import gulp from 'gulp'
import shell from 'gulp-shell'
import plumber from 'gulp-plumber'
import gutil from 'gulp-util'
import browsersync from 'browser-sync'
import rename from 'gulp-rename'
import sass from 'gulp-sass'
import postcss from 'gulp-postcss'
import autoprefixer from 'autoprefixer'
import cssnano from 'cssnano'
import concat from 'gulp-concat'
import uglify from 'gulp-uglify'

// Build CSS
gulp.task('css:dist', () => {
	// PostCSS plugins
	const plugins = [
		autoprefixer({browsers: ['last 1 version']}),
		cssnano({ mergeLonghand: false, zindex: false })
	];
	return gulp.src('./assets/src/scss/*.scss')
		.pipe(plumber({
			errorHandler: error => {
				gutil.beep()
				console.log(error)
			}
		}))
		.pipe(sass())
		.pipe(postcss(plugins))
		.pipe(rename({suffix: '.min'}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('./assets/dist/css/'))
		.pipe(browsersync.stream())
})

// Build JS
gulp.task('js:dist', () => {
	// App
	gulp.src(['./assets/src/js/vendor/*.js', './assets/src/js/app.js', './assets/src/js/*.js'])
		.pipe(plumber({
			errorHandler: error => {
				gutil.beep()
				console.log(error)
			}
		}))
		.pipe(concat('app.js'))
		.pipe(gulp.dest('./assets/dist/js'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify())
		.pipe(gulp.dest('./assets/dist/js/'))
})

// Watch
gulp.task('watch', ['css:dist'], () => {
	gulp.watch('./assets/src/scss/**/*.scss', ['css:dist']);
	gulp.watch('./assets/src/js/**/*.js', ['js:dist']);
})

// Default build
gulp.task('default', ['css:dist', 'js:dist'])