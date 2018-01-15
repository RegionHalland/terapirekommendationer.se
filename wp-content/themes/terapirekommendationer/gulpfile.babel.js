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
	gulp.src('./assets/src/js/*.js')
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

	// TinyMCE Plugins
	gulp.src('assets/src/mce-js/**/*.js')
		.pipe(plumber({
			errorHandler: error => {
				gutil.beep()
				console.log(error)
			}
		}))
		.pipe(uglify())
		.pipe(gulp.dest('./assets/dist/mce-js/'))
})

// Copy fonts to temporary directory
gulp.task('fonts:dist', () => {
	return gulp.src('./assets/src/fonts/*')
		.pipe(gulp.dest('./assets/dist/fonts/'))
});

// Generate PDF with Prince
// https://www.princexml.com/doc/8.1/command-line/
gulp.task('generate-pdf', ['css:dist'], shell.task([
	'prince --javascript assets/dist/html/tr.html'
]))

gulp.task('generate-pdf:dist', ['css:dist'], shell.task([
	'prince --javascript assets/dist/html/tr-klar.html'
]))

gulp.task('generate-pdf:rek', ['css:dist'], shell.task([
	'prince --javascript assets/dist/html/rek.html'
]))

gulp.task('generate-pdf:rek-ssk', ['css:dist'], shell.task([
	'prince --javascript assets/dist/html/rek-ssk.html'
]))


// Browsersync
gulp.task('browsersync', () => {
	browsersync.init({
		proxy: 'tr.test'
	});
})

// Browsersync reload
gulp.task('bs-reload', () => {
	browsersync.reload();
})

// Watch
gulp.task('watch', ['js:dist', 'css:dist', 'fonts:dist', 'browsersync'], () => {
	gulp.watch('./assets/src/scss/**/*.scss', ['css:dist', 'bs-reload']);
	// gulp.watch('./assets/src/scss/print-rek.scss', ['css:dist', 'generate-pdf:rek']);
	// gulp.watch('./assets/src/scss/print.scss', ['css:dist', 'generate-pdf']);
	gulp.watch(['./assets/src/js/**/*.js', 'assets/src/mce-js/**/*.js'], ['js:dist', 'bs-reload']);
})

// Default build
gulp.task('default', ['css:dist', 'fonts:dist', 'js:dist', 'generate-pdf', 'generate-pdf:rek'])