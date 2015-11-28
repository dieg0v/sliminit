var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');
var notify = require('gulp-notify');
var browserSync = require('browser-sync').create();
var runSequence = require('run-sequence');
var shell = require('gulp-shell')
var del = require('del');
var fs = require('fs');

var proxyServer = "localhost:8889",
    port = 3001;

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

/**
* Errors
*/
function swallowError (error) {
    console.log(error.toString());
    this.emit('end');
}

/**
* Defaut task
*/
gulp.task('default', ['watch'], shell.task([
  'php -S 0.0.0.0:8889 -t public'
]));

/**
* Watch task
*/
gulp.task('watch', ['browser-sync'], function () {

    gulp.watch([
        'public/static/css/**/*.css'
        ], ['css-build']
    ).on('change', browserSync.reload);;

    gulp.watch([
        'public/static/js/**/*.js',
        'public/static/js/**/*.json'
        ], ['js-build']
    ).on('change', browserSync.reload);

    gulp.watch([
        'public/static/media/img/**/*'
        ], ['images-build']
    ).on('change', browserSync.reload);

    gulp.watch([
        'app/views/**/*.mustache'
    ]).on('change', browserSync.reload);

});

gulp.task('js-build', function(callback) {
  runSequence(
    'js',
    callback
  );
});

gulp.task('css-build', function(callback) {
  runSequence(
    'css',
    callback
  );
});

gulp.task('images-build', function(callback) {
  runSequence(
    'images',
    callback
  );
});

/**
* Browser Sync options
*/
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: proxyServer,
        port: port,
        ghostMode: {
            clicks: true,
            location: true,
            forms: true,
            scroll: true
        },
        notify: false,
        open: true,
    });
});

/**
* Styles task
*/
gulp.task('css', function () {

    var dest_folder = 'public/static/build/css';

    var src = [];
    src.push('public/static/css/main.css');

    del(dest_folder + '/**/*');

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
        .pipe(concat(''+(new Date().getTime())+'.css'))
        .pipe(gulp.dest(dest_folder))
        .pipe(notify({message:"Compress css"})
    );
});

/**
* Concat and minify js
*/
gulp.task('js', function () {

    var dest_folder = 'public/static/build/js';
    var vendorJs = JSON.parse(fs.readFileSync('./public/static/js/js.json'));
    var src = [];

    del(dest_folder + '/**/*');

    for(var item in vendorJs.js) {
        console.log(vendorJs.js[item].src);
        src.push(vendorJs.js[item].src);
    }

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
    return del('public/static/build/media/img/**/*');
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
