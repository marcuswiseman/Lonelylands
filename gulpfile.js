var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var clean = require('gulp-clean');
const browserify = require("browserify");
const source = require('vinyl-source-stream');
const glob = require('glob');
const streamify = require('gulp-streamify');
const gulpif = require('gulp-if');
const uglify = require('gulp-uglify');

var styleSRC  = './src/scss/**/*.scss';
var styleSRC2 = '../node_modules/evocss/**/*.scss';
var styleDIST = './dist/css/';

var jsSRC = './src/js/**/*.js';
var jsCOMP = './dist/js/compiled.js';
var jsDIST = './dist/js/';

gulp.task('style', function () {
	console.log('--------------------------------------');
	console.log('[o] Compiling all SASS');
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
		.pipe(gulp.dest(styleDIST))
		.on('end', function() {
			console.log('[x] Finished');
		});
});

gulp.task('js', function () {
	var minify = true;
	console.log('--------------------------------------');
	console.log('[o] Compiling all JS');
	gulp.src(['./src/js/Classes/*.js', './src/js/Templates/*.js', './src/js/main.js'])
		.pipe(concat('compiled.js'))
		.pipe(gulp.dest(jsDIST))
		.on('end', function() {
			console.log('[|] Babelify-ing JS');
			var compiled = glob.sync(jsCOMP);
			compiled.map(function (file) {
				var name = file.replace("./dist/js/", "");
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
						basename: 'main',
						suffix: ".min",
						extname: ".js"
					}), rename({
						dirname: "",
						basename: 'main',
						extname: ".js"
					})))
					.pipe(gulpif(minify, streamify(uglify())))
					.pipe(gulp.dest(jsDIST))
					.on('end', function() {
						console.log('[|] Cleaning up');
						gulp.src(jsCOMP)
							.pipe(clean());
						console.log('[x] Finished');
					});
			});

	});


});


gulp.task('watch', function () {
	console.log('--------------------------------------');
	gulp.watch(styleSRC, ['style']);
	gulp.watch(styleSRC2, ['style']);
	gulp.watch(jsSRC, ['js']);
});