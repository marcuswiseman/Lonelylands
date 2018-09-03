var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
const browserify = require("browserify");
const source = require('vinyl-source-stream');
const glob = require('glob');
const streamify = require('gulp-streamify');
const gulpif = require('gulp-if');
const uglify = require('gulp-uglify');

var styleSRC  = './src/scss/**/*.scss';
var styleSRC2 = './node_modules/evocss/**/*.scss';
var styleDIST = './dist/css/';

var vueSRC = './src/js/**/*.js';
var vueDIST = './dist/js/';

gulp.task('style', function () {
	gulp.src(styleSRC)
		.pipe(sourcemaps.init())
		.pipe(sass({
			errorLogToConsole: true,
			outputStyle: 'compressed'
		}))
		.on('error', console.error.bind(console))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(rename({suffix: '.min'}))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(styleDIST));
});

gulp.task('vueify', function () {
	var minify = true;
	var files = glob.sync(vueSRC);
	files.map(function (file) {
		var name = file.replace("./src/js/", "");
		name = name.replace(".js", "");
		return browserify({entries: file, debug: true})
			.transform("babelify", {presets: ["env"]})
			.bundle()
			.on('error', function (err) {
				console.log(err.stack);
			})
			.pipe(source(file))
			.pipe(gulpif(minify, rename({
				dirname: "",
				basename: name,
				suffix: ".min",
				extname: ".js"
			}), rename({
				dirname: "",
				basename: name,
				extname: ".js"
			})))
			.pipe(gulpif(minify, streamify(uglify())))
			.pipe(gulp.dest(vueDIST));
	});
});


gulp.task('watch', function () {
	gulp.watch(styleSRC, ['style']);
	gulp.watch(styleSRC2, ['style']);
	gulp.watch(vueSRC, ['vueify']);
});