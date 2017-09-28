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
var browserSync    = require('browser-sync');

// Compile Our Sass
gulp.task('sass-dist', function() {
    return gulp.src('assets/source/sass/app.scss')
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.min'}))
            .pipe(cssnano({
                mergeLonghand: false,
                zindex: false
            }))
            .pipe(gulp.dest('assets/dist/css'))
            .pipe(browserSync.stream());
});

gulp.task('sass-dev', function() {
    return gulp.src('assets/source/sass/app.scss')
            .pipe(sass())
            .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
            .pipe(rename({suffix: '.dev'}))
            .pipe(gulp.dest('assets/dist/css'))
            .pipe(browserSync.stream());
});

// Concatenate & Minify JS
gulp.task('scripts-dist', function() {
    gulp.src('assets/source/js/*.js')
            .pipe(concat('app.js'))
            .pipe(gulp.dest('assets/dist/js'))
            .pipe(rename('app.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest('assets/dist/js'));
    
    gulp.src('assets/source/mce-js/*.js')
            .pipe(uglify())
            .pipe(gulp.dest('assets/dist/mce-js'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('assets/source/js/**/*.js', ['scripts-dist']);
    gulp.watch('assets/source/sass/**/*.scss', ['sass-dist', 'sass-dev']);
});


// Static Server + watching scss/html files
gulp.task('watch-bs', function() {
    browserSync.init({
        proxy: "tr.app"
    });

    gulp.watch('assets/source/sass/**/*.scss', ['sass-dist', 'sass-dev', 'shorthand']);
    gulp.watch(['assets/source/js/**/*.js', 'assets/source/mce-js/*.js'], ['scripts-dist']);
});

// Generate pdf with prince
gulp.task('shorthand', ['sass-dev', 'sass-dist'], shell.task([
  'prince -s ./assets/dist/css/app.dev.css assets/dist/html/tr.html'//,
  //'echo world'
]))

// Default Task
gulp.task('default', ['sass-dist', 'sass-dev', 'scripts-dist', 'watch']);

