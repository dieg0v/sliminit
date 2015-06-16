var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var clean = require('gulp-clean');
var watch = require('gulp-watch');
var notify = require('gulp-notify');

// GENERIC CSS
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');

// POSTCSS
var postcss = require('gulp-postcss');
var atImport = require("postcss-import");
var customProperties = require("postcss-custom-properties");
var customMedia = require('postcss-custom-media');
var calc = require("postcss-calc");
var colorFunction = require("postcss-color-function");

// IMAGEMIN
var imagemin = require('gulp-imagemin');

// LIVERELOAD
var livereload = require('gulp-livereload');

/**
* Errors
*/
function swallowError (error) {
    console.log(error.toString());
    this.emit('end');
}


/**
* Watch task
*/
gulp.task('watch', function () {
    livereload.listen();
    gulp.watch('public/static/css/**/*.css', ['css']);
    gulp.watch('public/static/js/**/*.js', ['js']);
});


/**
* Styles task
*/
gulp.task('css', function () {

    var dest_folder = 'public/static/build/css';

    var src = [];

    src.push('public/static/css/main.css');

    gulp.src(dest_folder + '/*', {read: false}).pipe(clean({force: true}));

    var minOpts = {processImport:false, keepSpecialComments:false};

    var processors = [
        atImport(),
        require('postcss-mixins'),
        require('postcss-nested'),
        customProperties(),
        customMedia(),
        calc(),
        colorFunction()
    ];

    return gulp.src(src)
        .pipe( postcss(processors) )
        .on('error', swallowError)
        .pipe(minifycss(minOpts))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 9', 'opera 12.1'))
        //.pipe(concat(''+(new Date().getTime())+'.css'))
        .pipe(concat('min.css'))
        .pipe(gulp.dest(dest_folder))
        .pipe(notify({message:"Compress css"})
        .pipe(livereload())
    );
});


/**
* Concat and minify js
*/
gulp.task('js', function () {

    var dest_folder = 'public/static/build/js';

    gulp.src(dest_folder + '/*', {read: false}).pipe(clean({force: true}));

    var src = [];

    src.push('public/static/vendor/modernizr/modernizr.js');
    src.push('public/static/vendor/jquery/dist/jquery.min.js');
    src.push('public/static/js/site.js');

    return gulp.src(src)
        .pipe(concat(''+(new Date().getTime())+'.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest_folder))
        .on('error', swallowError)
        .pipe(notify({message:"Compress js"})
    );
});


/**
* Optimize images with gulp-imagemin
*/
// Delete build images directory
gulp.task('cleanimages', function() {
    return gulp.src('public/static/build/media/img')
    .pipe(clean());
});

gulp.task('images',['cleanimages'], function () {
    return gulp.src('public/static/media/img/**/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}]
        }))
        .pipe(gulp.dest('public/static/build/media/img'))
        .pipe(notify({ message: 'Optimized images' }));
});
