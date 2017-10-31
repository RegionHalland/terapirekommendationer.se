// Include gulp
var gulp = require('gulp');
const shell = require('gulp-shell')

// Include Our Plugins
var sass 			= require('gulp-sass');
var concat 			= require('gulp-concat');
var uglify 			= require('gulp-uglify');
var cssnano 		= require('gulp-cssnano');
var rename 			= require('gulp-rename');
var autoprefixer 	= require('gulp-autoprefixer');
var plumber         = require('gulp-plumber');
var browserSync     = require('browser-sync');

// Compile Our Sass
gulp.task('css:dist', function() {
    return gulp.src('assets/src/scss/*.scss')
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.min'}))
            .pipe(cssnano({
                mergeLonghand: false,
                zindex: false
            }))
            .pipe(gulp.dest('assets/dist/css/'))
            .pipe(browserSync.stream());
});

gulp.task('css:dev', function() {
    return gulp.src('assets/src/scss/*.scss')
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.dev'}))
            .pipe(gulp.dest('assets/dist/css'))
            .pipe(browserSync.stream());
});


// Concatenate & Minify JS
gulp.task('scripts-dist', function() {
    gulp.src('assets/src/js/*.js')
            .pipe(plumber())
            .pipe(concat('app.js'))
            .pipe(gulp.dest('assets/dist/js'))
            .pipe(rename('app.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('assets/dist/js'));
    
    gulp.src('assets/src/mce-js/*.js')
            .pipe(plumber())
            .pipe(uglify())
            .pipe(gulp.dest('assets/dist/mce-js'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('assets/src/js/**/*.js', ['scripts-dist']);
    gulp.watch('assets/src/scss/**/*.scss', ['css:dist', 'css:dev']);
});


// Static Server + watching scss/html files
gulp.task('watch-bs', function() {
    browserSync.init({
        proxy: "tr.app"
    });

    gulp.watch('assets/src/scss/**/*.scss', ['css:dist', 'css:dev', 'shorthand']);
    gulp.watch(['assets/src/js/**/*.js', 'assets/src/mce-js/*.js'], ['scripts-dist']);
});

// Generate pdf with prince
gulp.task('shorthand', ['css:dev', 'css:dist'], shell.task([
  'prince -s ./assets/dist/css/print.min.css assets/dist/html/tr.html'//,
  //'echo world'
]))

// Default Task
gulp.task('default', ['css:dist', 'css:dev', 'scripts-dist', 'watch']);

