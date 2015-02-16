// Include gulp
var gulp = require('gulp');

 // Define base folders
var src = 'app/';

 // Include plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var less = require('gulp-less');
var clean = require('less-plugin-clean-css');
var minifyCSS = require('gulp-minify-css');
var minifyHTML = require('gulp-minify-html');
var sourcemaps = require('gulp-sourcemaps');
var jade = require('gulp-jade');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var merge = require('merge-stream');
var debug = require('gulp-debug');
var order = require("gulp-order");
var ignore = require("gulp-ignore");
var plugins = require("gulp-load-plugins")({
	pattern: ['gulp-*', 'gulp.*', 'main-bower-files'],
	replaceString: /\bgulp[\-.]/
});

 // Define default destination folder
var dest = 'public_html/';

var htmlopts = {comments:true,spare:true};

gulp.task('jade', function() {
  var YOUR_LOCALS = {};

  gulp.src(src + 'templates/*.jade')
    .pipe(jade({
      locals: YOUR_LOCALS
    }))
    //.pipe(minifyHTML(htmlopts))
    .pipe(gulp.dest(dest+'./templates/'))
});

gulp.task('html', function() {
  gulp.src(src + 'templates/*.html')
    //.pipe(minifyHTML(htmlopts))
    .pipe(gulp.dest(dest+'./templates/'))
});

 // Concatenate & Minify JS
gulp.task('scripts', function() {
 	var jsFiles = [src + 'scripts/*.js'];
  return gulp.src(plugins.mainBowerFiles().concat(jsFiles))
	  .pipe(plugins.filter('*.js'))
    .pipe(concat('main.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest(dest + 'js'));
});

gulp.task('css', function() {
 	var cssFiles = [src + 'styles/*.css'];
 	return gulp.src(plugins.mainBowerFiles().concat(cssFiles))
		.pipe(plugins.filter('*.css'))
		.pipe(order([
      "app/styles/site.css",
      "*"
    ]))
		//.pipe(debug({title: 'CSS Files:'}))
		.pipe(plugins.concat('main.css'))
		.pipe(minifyCSS({keepBreaks:true}))
		.pipe(gulp.dest(dest + 'css'));
});

 // Compile CSS from LESS files
gulp.task('less', function() {
    return gulp.src(src + 'styles/*.less')
        .pipe(concat('main.min.css'))
        .pipe(gulp.dest(dest + 'css'));
});

 gulp.task('images', function() {
  return gulp.src(src + 'assets/**/*')
    .pipe(cache(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
    .pipe(gulp.dest(dest + 'img'));
});

 // Watch for changes in files
gulp.task('watch', function() {
   // Watch .jade files
  gulp.watch(src + 'templates/*.jade', ['jade']);
   // Watch .html files
  gulp.watch(src + 'templates/*.html', ['html']);
   // Watch .js files
  gulp.watch(src + 'scripts/*.js', ['scripts']);
   // Watch .scss files
  gulp.watch(src + 'styles/*.less', ['less']);
   // Watch .scss files
  gulp.watch(src + 'styles/*.css', ['css']);
   // Watch image files
  gulp.watch(src + 'assets/**/*', ['images']);
 });
 // Default Task
gulp.task('default', ['scripts', 'css', 'less', 'images', 'html', 'jade']);