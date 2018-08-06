var gulp = require('gulp');
var sass = require('gulp-sass');
var jsmin = require('gulp-jsmin');
var minifyCss = require('gulp-minify-css');
var htmlmin = require('gulp-htmlmin');
var imagemin = require('gulp-imagemin');

// gulp start
gulp.task('start', function() {
	gulp.start('imagemin');
	gulp.start('css:watch');
	gulp.start('jsmin:watch');
	gulp.start('minify:watch');
	gulp.start('htmlmin:watch');
});


/*css*/
gulp.task('css', function(){
	gulp.src('./dev/css/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./css'));
});

gulp.task('css:watch', function(){
	gulp.watch('./dev/css/**/*.scss', ['css']);
});


// css min
gulp.task('minify-css', function(){
	return gulp.src('./css/*.css')
		.pipe(minifyCss({keepSpecialComments: 1}))
		.pipe(gulp.dest('css'))
});

gulp.task('minify:watch', function(){
	gulp.watch('./css/*.css', ['minify-css']);
});


// html min
gulp.task('htmlmin', function(){
	return gulp.src('./dev/views/**/*.html')
		.pipe(htmlmin({collapseWhitespace: true}))
		.pipe(gulp.dest('views'))
});

gulp.task('htmlmin:watch', function(){
	gulp.watch('./dev/views/**/*.html', ['htmlmin']);
});


// js min
gulp.task('jsmin', function(){
	return gulp.src('./dev/js/**/*.js')
		.pipe(jsmin())
		.pipe(gulp.dest('js'))
});

gulp.task('jsmin:watch', function(){
	gulp.watch('./dev/js/**/*.js', ['jsmin']);
});


// image minify
gulp.task('imagemin', function(){
	return gulp.src('./dev/img/**/**')
		.pipe(imagemin())
		.pipe(gulp.dest('img'))
});